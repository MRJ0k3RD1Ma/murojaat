<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AppealBajaruvchi;

/**
 * AppealBajaruvchiSearch represents the model behind the search form of `common\models\AppealBajaruvchi`.
 */
class AppealBajaruvchiSearch extends AppealBajaruvchi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'appeal_id', 'register_id', 'sender_id', 'deadline', 'status'], 'integer'],
            [['task', 'deadtime', 'created', 'letter', 'updated'], 'safe'],
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
        $query = AppealBajaruvchi::find();

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
            'company_id' => $this->company_id,
            'appeal_id' => $this->appeal_id,
            'register_id' => $this->register_id,
            'sender_id' => $this->sender_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'created' => $this->created,
            'status' => $this->status,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'task', $this->task])
            ->andFilterWhere(['like', 'letter', $this->letter]);

        return $dataProvider;
    }

    public function searchMy($params,$type=null,$id=0)
    {
        $query = AppealBajaruvchi::find();

        if($type=='company'){
            $query
                ->innerJoin('appeal_register','appeal_register.id=appeal_bajaruvchi.register_id')
                ->andWhere(['appeal_register.company_id'=>\Yii::$app->user->identity->company_id])
                ->andWhere(['appeal_bajaruvchi.company_id'=>$id])
                ->orderBy(['appeal_register.created'=>SORT_DESC])
            ;
        }elseif($type == 'answered'){
            $query = AppealBajaruvchi::find()
                ->where('register_id in (select id from appeal_register where company_id='.\Yii::$app->user->identity->company_id.')')
                ->orderBy(['updated'=>SORT_DESC]);
        }elseif($type=='my'){
            $query = AppealBajaruvchi::find()
                ->where('register_id in (select id from appeal_register where company_id='.\Yii::$app->user->identity->company_id.')')
                ->andWhere(['sender_id'=>\Yii::$app->user->identity->id]);
        }else{
            $query->where(['company_id'=>\Yii::$app->user->identity->company_id])->andWhere(['<=','status',1]);
        }
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
            'company_id' => $this->company_id,
            'appeal_id' => $this->appeal_id,
            'register_id' => $this->register_id,
            'sender_id' => $this->sender_id,
            'deadline' => $this->deadline,
            'deadtime' => $this->deadtime,
            'created' => $this->created,
            'status' => $this->status,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'task', $this->task])
            ->andFilterWhere(['like', 'letter', $this->letter]);

        return $dataProvider;
    }
}