<?php
namespace backend\controllers;

use common\models\Company;
use common\models\CompanyType;


class CompaniesController extends AuthController {

    public $modelClass = "common\models\Company";

    public function actionGettashkilot(){
## Read value
        $draw = isset($_POST['draw']) ? $_POST['draw'] : 1;
        $row = isset($_POST['start']) ? $_POST['start'] : 0;
        $rowperpage = isset($_POST['length']) ? $_POST['length'] : 10; // Rows display per page
        $columnIndex = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0; // Column index
        $columnName = isset($_POST['columns'][$columnIndex]['data']) ? $_POST['columns'][$columnIndex]['data'] : null; // Column name
        $columnSortOrder = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc'; // asc or desc

        if(isset($_POST['search']['value'])){
            $searchValue = $_POST['search']['value'];
        }else{
            $searchValue = null;
        }
## Search
        $searchQuery = "";
        if($searchValue != null){
            $searchQuery = " (name like '%".$searchValue."%' or 
            director like '%".$searchValue."%' or 
            phone like '%".$searchValue."%' or 
            inn like'%".$searchValue."%' ) ";
        }


        $totalRecords = Company::find()->count('id');

        ## Total number of records with filtering

        $totalRecordwithFilter = Company::find()->where($searchQuery)->count('id');



        $empRecords = Company::find()->where($searchQuery)->limit($rowperpage)->offset($row)->all();

        $data = array();

        foreach ($empRecords as $item){
            $data[] = array(
                'id'=>$item->id,
                'name'=>$item->name,
                'director'=>$item->director,
                'inn'=>$item->inn,
                'phone'=>$item->phone,
                'type'=>$item->type->name,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }


    public function actionOne($id){
        $model = Company::findOne($id);
        return $model;
    }

    public function actionCompanytype(){
        return CompanyType::find()->all();
    }
    public function actionCreateCompanyType(){
        $model = new CompanyType();
        if($model->load($this->request->post('')) and $model->save()){
            return true;
        }
        return false;
    }

    public function actionUpdateCompanyType($id){
        $model = CompanyType::findOne($id);
        if($model->load($this->request->post()) and $model->save()){
            return true;
        }
        return false;
    }

}
