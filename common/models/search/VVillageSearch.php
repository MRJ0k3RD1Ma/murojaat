<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VVillage;
use Yii;
/**
 * VVillageSearch represents the model behind the search form of `common\models\VVillage`.
 */
class VVillageSearch extends VVillage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'sector', 'soato_id', 'has_cl_problem', 'want_econom_energy', 'want_credit', 'credit_women', 'credit_young', 'want_subsidy', 'subsidy_women', 'subsidy_young', 'migrant', 'home_status_id'], 'integer'],
            [['date', 'road', 'address', 'person_name', 'person_birthday', 'econom_energy_credit', 'econom_energy_own', 'econom_energy', 'credit', 'subsidy'], 'safe'],
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
        $query = VVillage::find();

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
            'user_id' => $this->user_id,
            'sector' => $this->sector,
            'soato_id' => $this->soato_id,
            'date' => $this->date,
            'person_birthday' => $this->person_birthday,
            'has_cl_problem' => $this->has_cl_problem,
            'want_econom_energy' => $this->want_econom_energy,
            'want_credit' => $this->want_credit,
            'credit_women' => $this->credit_women,
            'credit_young' => $this->credit_young,
            'want_subsidy' => $this->want_subsidy,
            'subsidy_women' => $this->subsidy_women,
            'subsidy_young' => $this->subsidy_young,
            'migrant' => $this->migrant,
            'home_status_id' => $this->home_status_id,
        ]);

        $query->andFilterWhere(['like', 'road', $this->road])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'econom_energy_credit', $this->econom_energy_credit])
            ->andFilterWhere(['like', 'econom_energy_own', $this->econom_energy_own])
            ->andFilterWhere(['like', 'econom_energy', $this->econom_energy])
            ->andFilterWhere(['like', 'credit', $this->credit])
            ->andFilterWhere(['like', 'subsidy', $this->subsidy]);

        return $dataProvider;
    }

    public function searchVillage($params)
    {
        $query = VVillage::find()->where(['soato_id'=>Yii::$app->user->identity->company->soato_id]);

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
            'user_id' => $this->user_id,
            'sector' => $this->sector,
            'soato_id' => $this->soato_id,
            'date' => $this->date,
            'person_birthday' => $this->person_birthday,
            'has_cl_problem' => $this->has_cl_problem,
            'want_econom_energy' => $this->want_econom_energy,
            'want_credit' => $this->want_credit,
            'credit_women' => $this->credit_women,
            'credit_young' => $this->credit_young,
            'want_subsidy' => $this->want_subsidy,
            'subsidy_women' => $this->subsidy_women,
            'subsidy_young' => $this->subsidy_young,
            'migrant' => $this->migrant,
            'home_status_id' => $this->home_status_id,
        ]);

        $query->andFilterWhere(['like', 'road', $this->road])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'econom_energy_credit', $this->econom_energy_credit])
            ->andFilterWhere(['like', 'econom_energy_own', $this->econom_energy_own])
            ->andFilterWhere(['like', 'econom_energy', $this->econom_energy])
            ->andFilterWhere(['like', 'credit', $this->credit])
            ->andFilterWhere(['like', 'subsidy', $this->subsidy]);

        return $dataProvider;
    }
}
