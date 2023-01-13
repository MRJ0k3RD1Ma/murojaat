<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AppealAnswer;

/**
 * AppealAnswerSearch represents the model behind the search form of `common\models\AppealAnswer`.
 */
class AppealAnswerSearch extends AppealAnswer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'appeal_id', 'register_id', 'parent_id', 'bajaruvchi_id', 'reaply_send', 'status', 'status_boshqa'], 'integer'],
            [['preview', 'detail', 'number', 'date', 'tarqatma_number', 'tarqatma_date', 'name', 'file', 'created', 'updated'], 'safe'],
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
        $query = AppealAnswer::find();

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
            'appeal_id' => $this->appeal_id,
            'register_id' => $this->register_id,
            'parent_id' => $this->parent_id,
            'date' => $this->date,
            'tarqatma_date' => $this->tarqatma_date,
            'bajaruvchi_id' => $this->bajaruvchi_id,
            'reaply_send' => $this->reaply_send,
            'status' => $this->status,
            'status_boshqa' => $this->status_boshqa,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'tarqatma_number', $this->tarqatma_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
