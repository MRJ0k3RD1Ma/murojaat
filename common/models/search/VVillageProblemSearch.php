<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VVillageProblem;
use Yii;
/**
 * VVillageProblemSearch represents the model behind the search form of `common\models\VVillageProblem`.
 */
class VVillageProblemSearch extends VVillageProblem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'village_id', 'year', 'type_id', 'status_id', 'ranges'], 'integer'],
            [['kinship', 'name', 'detail'], 'safe'],
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
        $region_id = Yii::$app->user->identity->company->soato_id;
        $query = VVillageProblem::find()->select(['v_village_problem.*'])
            ->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.$region_id.'%")')
            ->orderBy(['v_village_problem.village_id'=>SORT_DESC])
        ;


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
            'village_id' => $this->village_id,
            'year' => $this->year,
            'type_id' => $this->type_id,
            'status_id' => $this->status_id,
            'ranges' => $this->ranges,
        ]);

        $query->andFilterWhere(['like', 'kinship', $this->kinship])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }


    public function searchNottask($params)
    {
        $region_id = Yii::$app->user->identity->company->soato_id;
        $query = VVillageProblem::find()->select(['v_village_problem.*'])
            ->innerJoin('v_village','v_village.id=v_village_problem.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.$region_id.'%")')
            ->andWhere(['<','status_id',3])
            ->orderBy(['v_village_problem.village_id'=>SORT_DESC])
        ;


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
            'village_id' => $this->village_id,
            'year' => $this->year,
            'type_id' => $this->type_id,
            'status_id' => $this->status_id,
            'ranges' => $this->ranges,
        ]);

        $query->andFilterWhere(['like', 'kinship', $this->kinship])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }

}
