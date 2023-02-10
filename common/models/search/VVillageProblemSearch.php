<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VVillageProblem;

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
            [['id', 'village_id', 'year'], 'integer'],
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
        $query = VVillageProblem::find();

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
        ]);

        $query->andFilterWhere(['like', 'kinship', $this->kinship])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }
}
