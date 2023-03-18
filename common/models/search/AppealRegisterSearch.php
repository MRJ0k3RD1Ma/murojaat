<?php

namespace common\models\search;

use common\models\AppealBajaruvchi;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AppealRegister;

/**
 * AppealRegisterSearch represents the model behind the search form of `common\models\AppealRegister`.
 */
class AppealRegisterSearch extends AppealRegister
{
    public  $person_name,$person_phone,$gender,$date_of_birth,$region_id,$district_id,$village_id,$address,$sts,$number;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'question_id', 'appeal_id', 'rahbar_id', 'ijrochi_id', 'parent_bajaruvchi_id', 'deadline', 'control_id', 'status', 'reply_send', 'company_id', 'answer_send', 'nazorat', 'takroriy', 'takroriy_id'], 'integer'],
            [['number', 'date', 'users', 'user_answer', 'tashkilot', 'tashkilot_answer', 'deadtime', 'donetime', 'created', 'updated', 'preview', 'detail', 'file', 'takroriy_date', 'takroriy_number'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AppealRegister::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'number' => $this->number,
            'control_id' => $this->control_id,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }

    public function searchMy($params)
    {
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()
            ->select(['appeal_register.*',
                '(select task_emp.status from task_emp where (reciever_id='.\Yii::$app->user->id.') and appeal_register.id=register_id limit 1) as mystatus'])
            ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
            ->where(['appeal_register.company_id'=>$user->company_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if($this->status == -1){
            $query->where('appeal_register.id in (select register_id from task_emp where reciever_id='.\Yii::$app->user->id.')')
                ->orderBy(['appeal_register.deadtime'=>SORT_DESC]);
        }else{
            $query->where('appeal_register.id in (select register_id from task_emp where (reciever_id='.\Yii::$app->user->id.') and status='.$this->status.')')
                ->orderBy(['appeal_register.deadtime'=>SORT_DESC]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'number' => $this->number,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }

    public function searchRegister($params,$type=null)
    {
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->innerJoin('appeal','appeal.id=appeal_register.appeal_id');
        //dead running closed;
        if($type == 'running'){
            $query->andWhere(['<>','appeal_register.status',4]);

        }elseif($type=='closed'){
            $query->andWhere(['=','appeal_register.status',4]);

        }elseif($type == 'dead'){
            $sql = "appeal_register.deadtime<date(now())";
            $query->andWhere(['<>','appeal_register.status',4])->andWhere($sql);
        }

        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $st = "1";
        switch ($this->sts){
            case "2": $st = 'appeal_register.status = 2'; break;
            case "3": $st = 'appeal_register.status <> 2'; break;
            case "4": $st = 'appeal_register.status <> 2 and appeal_register.deadtime<date(now())'; break;
        }
        $query->andWhere($st);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }

//status 1 bo'lganda ushbu search ishlaydi
    public function searchRegister1($params)
    {

        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
        ->andWhere('appeal.question_id=0 or appeal.question_id is null');


        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }

    public function searchRegister10($params)
    {
/*(SELECT
      COUNT(`a`.`id`)
    FROM (`appeal_register` `ar`
      JOIN `appeal` `a`
        ON (`ar`.`appeal_id` = `a`.`id`))
    WHERE `ar`.`company_id` IN (SELECT
        `c`.`id`
      FROM `company` `c`
      WHERE `c`.`parent_id` = `company`.`id`)
    AND (`a`.`question_id` = 0
    OR `a`.`question_id` IS NULL)) AS `count_not_quest_quyi`,*/
        $user = \Yii::$app->user->identity;
      $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->innerJoin('appeal','appeal.id=appeal_register.appeal_id');
            //->andWhere('company.parent_id = company.id');


        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegister2($params)
    {

        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
            ->andWhere('appeal.status=2 or appeal.status=3');


        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegister4($params)
    {

        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
            ->andWhere('appeal.status=4 ');


        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }


    public function searchRegisterAll2($params)
    {

       $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->innerJoin('appeal','appeal.id=appeal_register.appeal_id');
            /*->andWhere('user.company_id=company.parent_id');*/



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }

    public function searchRegisterAll1($params)
    {/*SELECT
      COUNT(`ab`.`id`)
    FROM `appeal_bajaruvchi` `ab`
    WHERE `ab`.`company_id` = `company`.`id`
    AND `ab`.`sender_id` IN (SELECT
        `user`.`id`
      FROM `user`
      WHERE `user`.`company_id` = `company`.`parent_id`
      AND `user`.`status` = 1)) AS `count_quyi`,*/

        /*
          $model = Product::find()
->innerJoinWith('t', 'Product.id = T.productId')
->andWhere(['T.productFeatureValueId' => ''])
->innerJoinWith('t1', 'Product.id = T1.productId')
->andWhere(['T1.productFeatureValueId' => '5'])
->all();
        */

        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->innerJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = '.$user->company_id)
            ->andWhere('appeal_bajaruvchi.sender_id IN (SELECT `user`.`id` FROM `user` WHERE `user`.`company_id`='.$user->company_id.')' );



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll3($params)
    {/*SELECT
      COUNT(`ab`.`id`)
    FROM `appeal_bajaruvchi` `ab`
    WHERE `ab`.`company_id` = `company`.`id`
    AND `ab`.`sender_id` IN (SELECT
        `user`.`id`
      FROM `user`
      WHERE `user`.`company_id` IN (SELECT
          `c`.`id`
        FROM `company` `c`
        WHERE `c`.`parent_id` = `company`.`id`))) AS `count_quyi_send`,,*/


        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()
            ->innerJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = appeal_register.company_id')
            ->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_bajaruvchi.sender_id IN 
            (SELECT `user`.`id` FROM `user` WHERE `user`.`company_id` IN (SELECT `c`.`id`  FROM `company` `c`  WHERE `c`.`parent_id` = '.$user->company_id.'))' );



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll31($params)
    {/*SELECT
      COUNT(`ab`.`id`)
    FROM `appeal_bajaruvchi` `ab`
    WHERE `ab`.`company_id` = `company`.`id`
    AND `ab`.`sender_id` IN (SELECT
        `user`.`id`
      FROM `user`
      WHERE `user`.`company_id` IN (SELECT
          `c`.`id`
        FROM `company` `c`
        WHERE `c`.`parent_id` = `company`.`id`))) AS `count_quyi_send`,,*/


        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()
            ->innerJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = appeal_register.company_id')
            ->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_bajaruvchi.sender_id IN 
            (SELECT `user`.`id` FROM `user` WHERE `user`.`company_id` IN (SELECT `c`.`id`  FROM `company` `c`  WHERE `c`.`parent_id` = '.$user->company_id.'))' )
        ->andWhere('appeal_bajaruvchi.status IN (0,1)');



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }

    public function searchRegisterAll32($params)
    {
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()
            ->innerJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = appeal_register.company_id')
            ->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_bajaruvchi.sender_id IN 
            (SELECT `user`.`id` FROM `user` WHERE `user`.`company_id` IN (SELECT `c`.`id`  FROM `company` `c`  WHERE `c`.`parent_id` = '.$user->company_id.'))' )
            ->andWhere('appeal_bajaruvchi.status=2');



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll33($params)
    {
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()
            ->innerJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = appeal_register.company_id')
            ->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_bajaruvchi.sender_id IN 
            (SELECT `user`.`id` FROM `user` WHERE `user`.`company_id` IN (SELECT `c`.`id`  FROM `company` `c`  WHERE `c`.`parent_id` = '.$user->company_id.'))' )
            ->andWhere('appeal_bajaruvchi.status=4');



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll37($params)
    {/*(SELECT
      COUNT(`ab`.`id`)
    FROM `appeal_bajaruvchi` `ab`
    WHERE `ab`.`company_id` = `company`.`id`--
    AND `ab`.`sender_id` IN (SELECT
        `user`.`id`
      FROM `user`
      WHERE `user`.`company_id` IN (SELECT
          `c`.`id`
        FROM `company` `c`
        WHERE `c`.`parent_id` = `company`.`id`
        AND `ab`.`created` LIKE '%' + CURDATE() + '%'))) AS `count_quyi_send_today`,*/
        $user = \Yii::$app->user->identity;
        $query = AppealBajaruvchi::find()
//            ->innerJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = appeal_register.company_id')
            ->where(['appeal_bajaruvchi.company_id'=>$user->company_id])
            ->andWhere('appeal_bajaruvchi.sender_id IN 
            (SELECT `user`.`id` FROM `user` WHERE `user`.`company_id` IN (SELECT `c`.`id`  FROM `company` `c`  WHERE `c`.`parent_id` = '.$user->company_id.'))' )
            ->andWhere('appeal_bajaruvchi.created LIKE CURDATE()')
            ->andWhere('appeal_bajaruvchi.status IN (0,1)');



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll38($params)
    {/*(SELECT
      COUNT(`ab`.`id`)
    FROM `appeal_bajaruvchi` `ab`
    WHERE `ab`.`company_id` = `company`.`id`--
    AND `ab`.`sender_id` IN (SELECT
        `user`.`id`
      FROM `user`
      WHERE `user`.`company_id` IN (SELECT
          `c`.`id`
        FROM `company` `c`
        WHERE `c`.`parent_id` = `company`.`id`
        AND `ab`.`created` LIKE '%' + CURDATE() + '%'))) AS `count_quyi_send_today`,*/
        $user = \Yii::$app->user->identity;
        $query = AppealBajaruvchi::find()
//            ->innerJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = appeal_register.company_id')
            ->where(['appeal_bajaruvchi.company_id'=>$user->company_id])
            ->andWhere('appeal_bajaruvchi.sender_id IN 
            (SELECT `user`.`id` FROM `user` WHERE `user`.`company_id` IN (SELECT `c`.`id`  FROM `company` `c`  WHERE `c`.`parent_id` = '.$user->company_id.'))' )
            ->andWhere('appeal_bajaruvchi.created LIKE CURDATE()')
            ->andWhere('appeal_bajaruvchi.status IN (2,3)');



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll11($params)
    {
/*SELECT
      COUNT(`ab`.`id`)
    FROM `appeal_bajaruvchi` `ab`
    WHERE `ab`.`company_id` = `company`.`id`
    AND `ab`.`sender_id` IN (SELECT
        `user`.`id`
      FROM `user`
      WHERE `user`.`company_id` = `company`.`parent_id`
      AND `user`.`status` = 1
      AND `ab`.`status` = 0)) AS `count_quyi_yangi`,*/

        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->innerJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = '.$user->company_id)
            ->andWhere('appeal_bajaruvchi.sender_id IN (SELECT `user`.`id` FROM `user` WHERE `user`.`company_id`='.$user->company_id.')' )
            ->andWhere('appeal_bajaruvchi.status=0');



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll12($params)
    {
        /*SELECT
              COUNT(`ab`.`id`)
            FROM `appeal_bajaruvchi` `ab`
            WHERE `ab`.`company_id` = `company`.`id`
            AND `ab`.`sender_id` IN (SELECT
                `user`.`id`
              FROM `user`
              WHERE `user`.`company_id` = `company`.`parent_id`
              AND `user`.`status` = 1
              AND `ab`.`status` = 0)) AS `count_quyi_yangi`,*/

        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->innerJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = '.$user->company_id)
            ->andWhere('appeal_bajaruvchi.sender_id IN (SELECT `user`.`id` FROM `user` WHERE `user`.`company_id`='.$user->company_id.')' )
            ->andWhere('appeal_bajaruvchi.status IN (2,3)');



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }

    public function searchRegisterAll14($params)
    {
        /*SELECT
              COUNT(`ab`.`id`)
            FROM `appeal_bajaruvchi` `ab`
            WHERE `ab`.`company_id` = `company`.`id`
            AND `ab`.`sender_id` IN (SELECT
                `user`.`id`
              FROM `user`
              WHERE `user`.`company_id` = `company`.`parent_id`
              AND `user`.`status` = 1
              AND `ab`.`status` = 0)) AS `count_quyi_yangi`,*/

        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->innerJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = '.$user->company_id)
            ->andWhere('appeal_bajaruvchi.sender_id IN (SELECT `user`.`id` FROM `user` WHERE `user`.`company_id`='.$user->company_id.')' )
            ->andWhere('appeal_bajaruvchi.status=4');



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll210($params)
    {/*SELECT
      COUNT(`ar`.`id`)
    FROM `appeal_register` `ar`
    WHERE `ar`.`parent_bajaruvchi_id` IS NULL
    AND `ar`.`company_id` = `company`.`id`
    AND `ar`.`status` = 1) AS `count_tugri_yangi`,*/

        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_register.parent_bajaruvchi_id IS NULL')
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')
        ->andWhere('appeal_register.status=1');
        /*->andWhere('user.company_id=company.parent_id');*/



        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll220($params)
    {
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_register.parent_bajaruvchi_id IS NULL')
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.status=2 or appeal_register.status=3');




        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll24($params)
    {
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_register.parent_bajaruvchi_id IS NULL')
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.status=4');




        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll17($params)
    {/*SELECT
      COUNT(`ab`.`id`)
    FROM `appeal_bajaruvchi` `ab`
    WHERE `ab`.`status` < 2
    AND `ab`.`company_id` = `company`.`id`
    AND `ab`.`created` LIKE '%' + CURDATE() + '%') AS `count_yuqori_today`,*/
        $user = \Yii::$app->user->identity;
        $query = AppealBajaruvchi::find()->where(['appeal_bajaruvchi.company_id'=>$user->company_id])
            ->andWhere('appeal_bajaruvchi.status < 2')
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_bajaruvchi.created  LIKE  CURDATE() ');




        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll18($params)
    {/*SELECT
      COUNT(`ab`.`id`)
    FROM `appeal_bajaruvchi` `ab`
    WHERE `ab`.`status` < 2
    AND `ab`.`company_id` = `company`.`id`
    AND `ab`.`created` LIKE '%' + CURDATE() + '%') AS `count_yuqori_today`,*/
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_register.status = 2')
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.created  LIKE  CURDATE() ');




        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll27($params)
    {
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.status > 2')
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.created  LIKE  CURDATE() ');




        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }

    public function searchRegisterAll28($params)
    {
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.status IN (2,3)')
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.created  LIKE  CURDATE() ');




        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll100($params)
    {/*SELECT
      COUNT(`ar`.`id`)
    FROM `appeal_register` `ar`
    WHERE `ar`.`deadtime` <= CURDATE() + INTERVAL 2 DAY
    AND `ar`.`company_id` = `company`.`id`----
    AND `ar`.`status` <> 4) AS `count_date_interval`---,*/
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.status <> 4')
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.deadtime  = CURDATE() + INTERVAL 1 DAY ');




        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll29($params)
    {/*SSELECT
      COUNT(`ar`.`id`)
    FROM `appeal_register` `ar`
    WHERE `ar`.`deadtime` >= CURDATE() + INTERVAL 0 DAY
    AND `ar`.`deadtime` = CURDATE() + INTERVAL 1 DAY
    AND `ar`.`company_id` = `company`.`id`
    AND `ar`.`parent_bajaruvchi_id` IS NULL
    AND `ar`.`status` <> 4) AS `count_today_interval`,,`---,*/
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.status <> 4')
            ->andWhere('appeal_register.deadtime  <= CURDATE() + INTERVAL 2 DAY ')
            ->andWhere('appeal_register.deadtime  >= CURDATE()');
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')




        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll300($params)
    {/*SSELECT
      COUNT(`ar`.`id`)
    FROM `appeal_register` `ar`
    WHERE `ar`.`deadtime` >= CURDATE() + INTERVAL 0 DAY
    AND `ar`.`deadtime` = CURDATE() + INTERVAL 1 DAY
    AND `ar`.`company_id` = `company`.`id`
    AND `ar`.`parent_bajaruvchi_id` IS NULL
    AND `ar`.`status` <> 4) AS `count_today_interval`,,`---,*/
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.status <> 4')
            ->andWhere('appeal_register.deadtime  = CURDATE() ');
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')




        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
    public function searchRegisterAll301($params)
    {/*SSELECT
      COUNT(`ar`.`id`)
    FROM `appeal_register` `ar`
    WHERE `ar`.`deadtime` >= CURDATE() + INTERVAL 0 DAY
    AND `ar`.`deadtime` = CURDATE() + INTERVAL 1 DAY
    AND `ar`.`company_id` = `company`.`id`
    AND `ar`.`parent_bajaruvchi_id` IS NULL
    AND `ar`.`status` <> 4) AS `count_today_interval`,,`---,*/
        $user = \Yii::$app->user->identity;
        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])
            ->andWhere('appeal_register.parent_bajaruvchi_id IS NULL')
            ->andWhere('appeal_register.status <> 4')
            ->andWhere('appeal_register.deadtime  <= CURDATE() + INTERVAL 2 DAY ')
        ->andWhere('appeal_register.deadtime  >= CURDATE()+1');
//        ->innerJoin('appeal_register','appeal_register.parent_bajaruvchi_id IS NULL')




        $query->orderBy(['date'=>SORT_DESC]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'appeal_register.question_id' => $this->question_id,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'reply_send' => $this->reply_send,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,
        ]);

        $query->andFilterWhere(['like', 'appeal_register.number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'user_answer', $this->user_answer])
            ->andFilterWhere(['like', 'tashkilot', $this->tashkilot])
            ->andFilterWhere(['like', 'tashkilot_answer', $this->tashkilot_answer])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number]);

        return $dataProvider;
    }
}
