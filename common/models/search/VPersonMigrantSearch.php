<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VPersonMigrant;

/**
 * VPersonMigrantSearch represents the model behind the search form of `common\models\VPersonMigrant`.
 */
class VPersonMigrantSearch extends VPersonMigrant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'village_id'], 'integer'],
            [['person_name', 'birthday'], 'safe'],
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
        $query = VPersonMigrant::find();

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
            'birthday' => $this->birthday,
        ]);

        $query->andFilterWhere(['like', 'person_name', $this->person_name]);

        return $dataProvider;
    }
}
