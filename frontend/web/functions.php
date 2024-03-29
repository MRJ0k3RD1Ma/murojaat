<?php

use common\models\AppealBajaruvchi;
use common\models\TaskEmp;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function debug($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
function prettyNumber($num){
    $num = "{$num}";
    $n="";
    $t=strlen($num);
    for($i=0; $i<$t; $i++){
        if($i!=0 and $i%3==0){
            $n.=' ';
        }
        $n .= $num[$t-$i-1];
    }
    $res = "";
    $t = strlen($n);
    for ($i=0; $i<$t; $i++){
        $res .= $n[$t-$i-1];
    }
    return $res;
}
function exportToExcel($label=null,$data=null){

    ini_set('memory_limit', '2048M');
    ini_set('max_execution_time ', '200');
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray($data,null,'B2');
    $sheet->fromArray($label,null,'A1');

    $tr=[];
    $tr[0][0]='Т\р';
    for ($i=1;$i<=sizeof($data);$i++)
        $tr[$i][0]=$i;
    $sheet->fromArray($tr,'A3');

    $writer = new Xlsx($spreadsheet);
    $writer->save('filename.xlsx');
    Yii::$app->response->sendFile('filename.xlsx');
}

function numberToRomanRepresentation($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}

function getColor($status){
    $color = [
        1=>'bg-warning',
        0=>'bg-info',
        2=>'bg-success',
        3=>'bg-danger'
    ];
    return $color[$status];
}


// type some code
function closeAppeal($id,$reg_id,$c_id){
    $reg = \common\models\AppealRegister::find()->where(['appeal_id'=>$id])->andWhere(['>=','id',$reg_id])->all();

    foreach ($reg as $item){
        $item->status = 4;
        $item->control_id = $c_id;
        $item->donetime = date('Y-m-d');

        $emp = TaskEmp::find()->where(['appeal_id'=>$id])->andWhere(['register_id'=>$item->id])->all();

        foreach ($emp as $e){
            $e->status = 4;
            $e->save();
        }
        $item->save();
    }

    $bajs = AppealBajaruvchi::find()->where(['appeal_id'=>$id])->andWhere(['>=','register_id',$reg_id])->all();
    foreach ($bajs as $item) {
        $item->status = 4;
        $item->save(false);
    }

}

function changeTime($id){
    $model = \common\models\Request::findOne($id);
    $model->status_id = 2;
    if($model->save()){
        $register = $model->register;
        $appeal = $model->appeal;
        // murojaat javobi hodimdan kelgan holda hodimga berilgan topshiriq muddatini o'zgartirish
        if($model->sender->company_id == Yii::$app->user->identity->company_id){
            if($task = TaskEmp::find()->where(['appeal_id'=>$appeal->id])
                ->andWhere(['register_id'=>$register->id])
                ->andWhere(['reciever_id'=>$model->sender_id])->one()){
                $task->deadtime = date('Y-m-d',strtotime($model->date));
                $task->save(false);
            }
            if(!$register->parent_bajaruvchi_id){
                if(new DateTime($model->date) > new DateTime($register->deadtime)){
                    $register->deadtime = $model->date;
                    $register->save();
                }
            }
        }else{


            $task = AppealBajaruvchi::findOne($register->parent_bajaruvchi_id);
            $task->deadtime = $model->date;
            $register->deadtime = $model->date;
            $task->save();
            $register->save();
            if(new DateTime($model->date) > new DateTime($register->deadtime)){
                $register->deadtime = $model->date;
                $register->save();
            }

            if(!$task->register->parent_bajaruvchi_id){
                if(new DateTime($appeal->deadtime) < new DateTime($register->deadtime)){
                    $appeal->deadtime = $register->deadtime;
                    $appeal->save();
                    $reg = \common\models\AppealRegister::findOne($task->register_id);
                    $reg->deadtime = $register->deadtime;
                    $reg->save(false);
                }
            }

        }
        return true;
    }else{
        return false;
    }
}
function changeCompany($id){
    $model = \common\models\Request::findOne($id);
    $model->status_id = 2;
    if($model->save()){
        $register = $model->register;
        $appeal = $model->appeal;
        // murojaatni quyi tashkilotdan olib tashlash o'chirish yoki topshiriq berilgan xodimdan o'chirish.
        if($model->sender->company_id == Yii::$app->user->identity->company_id){
            // hodimlar kesimida yana ham ko'rib chiqish kerak
            /*$task = TaskEmp::find()->where(['appeal_id'=>$appeal->id])
                ->andWhere(['register_id'=>$register->id])
                ->andWhere(['reciever_id'=>$model->sender_id])->one();
            $task->delete();

            */
        }else{
            $task = AppealBajaruvchi::findOne($register->parent_bajaruvchi_id);

            deleteTask($task->id);
        }
    }
}

function deleteTask($tid){
    $task = AppealBajaruvchi::findOne($tid);
    $register = \common\models\AppealRegister::find()->where(['parent_bajaruvchi_id'=>$task->id])
        ->andWhere(['company_id'=>$task->company_id])
        ->andWhere(['appeal_id'=>$task->appeal_id])->one();
    foreach (TaskEmp::find()->where(['register_id'=>$register->id])->all() as $item){
        $item->delete();
    }
    $ans = \common\models\AppealAnswer::find()->where(['register_id'=>$register->id])->all();
    foreach ($ans as $item){
        $item->delete();
    }
    foreach (AppealBajaruvchi::find()->where(['register_id'=>$register->id])->all() as $item){
        deleteTask($item->id);
    }


    $register->delete();
    $task->delete();
}
?>