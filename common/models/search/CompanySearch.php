<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Company;
use Yii;
/**
 * CompanySearch represents the model behind the search form of `common\models\Company`.
 */
class CompanySearch extends Company
{
    public $region_id,$district_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'soato_id', 'status_id', 'parent_id','paid','region_id','district_id'], 'integer'],
            [['inn', 'name', 'director', 'phone', 'telegram', 'phone_director', 'paid_date','created', 'updated', 'address', 'location', 'lat', 'long', 'ads', 'cadastre'], 'safe'],
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
        $query = Company::find();

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
        if($this->paid === 0){
               $query->andWhere(['paid'=>0]);
           }elseif($this->paid == 1){
               $now = date('Y-m-d h:i:s');
               $query->andWhere(['<','paid_date',date('Y-m-d',strtotime($now.' -1 YEAR'))]);
           }elseif($this->paid == 2){
               $now = date('Y-m-d h:i:s');
               $query->andWhere(['paid'=>1])->andWhere(['>','paid_date',date('Y-m-d',strtotime($now.' -1 YEAR'))]);
         }
        $addr = $this->region_id.$this->district_id;
        if($this->soato_id){
            $addr = $this->soato_id;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
//            'soato_id' => $this->soato_id,
            'status_id' => $this->status_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'parent_id' => $this->parent_id,
            'paid' => $this->paid,
        ]);

        $query->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'phone_director', $this->phone_director])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'long', $this->long])
            ->andFilterWhere(['like', 'ads', $this->ads])
            ->andFilterWhere(['like', 'paid_date', $this->paid_date])
            ->andFilterWhere(['like', 'soato_id', $addr])
            ->andFilterWhere(['like', 'cadastre', $this->cadastre]);


        return $dataProvider;
    }
public function searchMytask($params)
    {
        $uid = Yii::$app->user->id;

        $query = Company::find()->select(['company.*',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id) as cntall',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.status=0 and appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id) as cnt0',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.status=1 and appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id) as cnt1',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.status=2 and appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id) as cnt2',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.status=3 and appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id) as cnt3',
//            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.status=4 and appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id) as cnt4',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.control=2 and appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id) as cnti',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.control=4 and appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id) as cntt',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.status=5 and appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id) as cnt5',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.deadtime<date(now()) and appeal_register.status<>4 and appeal_register.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cntdead',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.deadtime<date(now()) and appeal_register.status=4 and appeal_register.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cntwithdead',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id and appeal_register.control_id <> 0) as cnt_nazorat',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id and appeal_register.control_id <> 2) as cnt_6',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id and appeal_register.control_id <> 3) as cnt_7',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id and appeal_register.control_id <> 4) as cnt_8',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id and appeal_register.control_id <> 5) as cnt_9',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id and appeal_register.control_id <> 6) as cnt_10',
            '(select count(appeal_register.sender_id) from appeal_register WHERE appeal_register.sender_id ='.$uid.' and appeal_register.company_id=company.id and appeal_register.control_id <> 7) as cnt_11',

//            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id <> 0) as cnt_nazorat',
//            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 2) as cnt_6',
//            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 3) as cnt_7',
//            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 4) as cnt_8',
//            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 5) as cnt_9',
//            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 6) as cnt_10',
//            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 7) as cnt_11',
//            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.status = 2 and deadtime<date(now())) as cnt_dead',
//            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.status = 4 and deadtime<donetime ) as cnt_done_dead',
        ])
            ->orderBy(['cntall'=>SORT_DESC]);
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
            'type_id' => $this->type_id,
            'soato_id' => $this->soato_id,
            'status_id' => $this->status_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'phone_director', $this->phone_director])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'long', $this->long])
            ->andFilterWhere(['like', 'ads', $this->ads])
            ->andFilterWhere(['like', 'cadastre', $this->cadastre]);

        return $dataProvider;
    }

    public function searchStatus($params)
    {
        $cid = \Yii::$app->user->identity->company_id;
        $query = Company::find()->select([
            'company.*',
            'count(ab.company_id) as cntall',
            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id WHERE appeal_bajaruvchi.company_id=company.id AND appeal_register.company_id='.$cid.' and appeal_bajaruvchi.status=0) AS cnt0',
            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id WHERE appeal_bajaruvchi.company_id=company.id AND appeal_register.company_id='.$cid.' and appeal_bajaruvchi.status=1) AS cnt1',
            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id WHERE appeal_bajaruvchi.company_id=company.id AND appeal_register.company_id='.$cid.' and appeal_bajaruvchi.status=2) AS cnt2',
            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id WHERE appeal_bajaruvchi.company_id=company.id AND appeal_register.company_id='.$cid.' and appeal_bajaruvchi.status=3) AS cnt3',
            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id WHERE appeal_bajaruvchi.company_id=company.id AND appeal_register.company_id='.$cid.' and appeal_bajaruvchi.status=4) AS cnt4',
//            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id WHERE appeal_bajaruvchi.company_id=company.id AND appeal_register.company_id='.$cid.' and appeal_register.control_id=4 and appeal_bajaruvchi.status=4) AS cntt',
            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id WHERE appeal_bajaruvchi.company_id=company.id AND appeal_register.company_id='.$cid.' and appeal_bajaruvchi.status=5) AS cnt5',
            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi 
            INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id 
            WHERE appeal_bajaruvchi.company_id=company.id 
            AND appeal_register.company_id='.$cid.' 
            AND appeal_bajaruvchi.status<>4 
            AND appeal_bajaruvchi.deadtime<date(now())) AS cntdead',
            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi 
            INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id 
            WHERE appeal_bajaruvchi.company_id=company.id 
            AND appeal_register.company_id='.$cid.' 
            AND appeal_bajaruvchi.status=4 
            AND appeal_bajaruvchi.deadtime<date(now())) AS cntwithdead',

            "(select count(*) FROM appeal_register WHERE appeal_register.parent_bajaruvchi_id in (select id from appeal_bajaruvchi where appeal_bajaruvchi.company_id = company.id and appeal_bajaruvchi.sender_id in (select user.id from user where user.company_id={$cid}) )) as cnt_nazorat",
            "(select count(*) FROM appeal_register WHERE appeal_register.control_id = 2 and appeal_register.parent_bajaruvchi_id in (select id from appeal_bajaruvchi where appeal_bajaruvchi.company_id = company.id and appeal_bajaruvchi.sender_id in (select user.id from user where user.company_id={$cid}) )) as cnt_6",
            "(select count(*) FROM appeal_register WHERE appeal_register.control_id = 3 and appeal_register.parent_bajaruvchi_id in (select id from appeal_bajaruvchi where appeal_bajaruvchi.company_id = company.id and appeal_bajaruvchi.sender_id in (select user.id from user where user.company_id={$cid}) )) as cnt_7",
            "(select count(*) FROM appeal_register WHERE appeal_register.control_id = 4 and appeal_register.parent_bajaruvchi_id in (select id from appeal_bajaruvchi where appeal_bajaruvchi.company_id = company.id and appeal_bajaruvchi.sender_id in (select user.id from user where user.company_id={$cid}) )) as cnt_8",
            "(select count(*) FROM appeal_register WHERE appeal_register.control_id = 5 and appeal_register.parent_bajaruvchi_id in (select id from appeal_bajaruvchi where appeal_bajaruvchi.company_id = company.id and appeal_bajaruvchi.sender_id in (select user.id from user where user.company_id={$cid}) )) as cnt_9",
            "(select count(*) FROM appeal_register WHERE appeal_register.control_id = 6 and appeal_register.parent_bajaruvchi_id in (select id from appeal_bajaruvchi where appeal_bajaruvchi.company_id = company.id and appeal_bajaruvchi.sender_id in (select user.id from user where user.company_id={$cid}) )) as cnt_10",
            "(select count(*) FROM appeal_register WHERE appeal_register.control_id = 7 and appeal_register.parent_bajaruvchi_id in (select id from appeal_bajaruvchi where appeal_bajaruvchi.company_id = company.id and appeal_bajaruvchi.sender_id in (select user.id from user where user.company_id={$cid}) )) as cnt_11",

        ])->innerJoin('appeal_bajaruvchi ab','company.id = ab.company_id ')
        ->innerJoin('appeal_register ar','ab.register_id = ar.id')
        ->where(['ar.company_id'=>$cid])->groupBy(['company.id'])->orderBy(['cntall'=>SORT_DESC]);

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
            'type_id' => $this->type_id,
            'soato_id' => $this->soato_id,
            'status_id' => $this->status_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'phone_director', $this->phone_director])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'long', $this->long])
            ->andFilterWhere(['like', 'ads', $this->ads])
            ->andFilterWhere(['like', 'cadastre', $this->cadastre]);

        return $dataProvider;
    }
}
