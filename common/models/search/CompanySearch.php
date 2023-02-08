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
            '(select count(appeal_bajaruvchi.sender_id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cntall',
            '(select count(appeal_bajaruvchi.sender_id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.status=0 and appeal_bajaruvchi.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cnt0',
            '(select count(appeal_bajaruvchi.sender_id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.status=1 and appeal_bajaruvchi.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cnt1',
            '(select count(appeal_bajaruvchi.sender_id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.status=2 and appeal_bajaruvchi.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cnt2',
            '(select count(appeal_bajaruvchi.sender_id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.status=3 and appeal_bajaruvchi.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cnt3',
            '(select count(appeal_bajaruvchi.sender_id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.status=4 and appeal_bajaruvchi.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cnt4',
            '(select count(appeal_bajaruvchi.sender_id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.status=5 and appeal_bajaruvchi.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cnt5',
            '(select count(appeal_bajaruvchi.sender_id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.deadtime<date(now()) and appeal_bajaruvchi.status<>4 and appeal_bajaruvchi.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cntdead',
            '(select count(appeal_bajaruvchi.sender_id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.deadtime<date(now()) and appeal_bajaruvchi.status=4 and appeal_bajaruvchi.sender_id ='.$uid.' and appeal_bajaruvchi.company_id=company.id) as cntwithdead',

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
            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id WHERE appeal_bajaruvchi.company_id=company.id AND appeal_register.company_id='.$cid.' and appeal_bajaruvchi.status=5) AS cnt5',
            '(select count(appeal_bajaruvchi.id) FROM appeal_bajaruvchi INNER JOIN appeal_register ON appeal_bajaruvchi.register_id = appeal_register.id WHERE appeal_bajaruvchi.company_id=company.id AND appeal_register.company_id='.$cid.' and appeal_bajaruvchi.status<>4 and appeal_bajaruvchi.deadtime<date(now())) AS cntdead',
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
