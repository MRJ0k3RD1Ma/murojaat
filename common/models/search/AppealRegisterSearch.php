<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AppealRegister;

/**
 * AppealRegisterSearch represents the model behind the search form of `common\models\AppealRegister`.
 */
class AppealRegisterSearch extends AppealRegister
{
    public $question_id, $person_name,$person_phone,$gender,$date_of_birth,$region_id,$district_id,$village_id,$address,$sts;
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
            'question_id' => $this->question_id,
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

        $query->andFilterWhere(['like', 'number', $this->number])
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
