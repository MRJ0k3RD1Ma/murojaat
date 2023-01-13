<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaskEmp;

/**
 * TaskEmpSearch represents the model behind the search form of `common\models\TaskEmp`.
 */
class TaskEmpSearch extends TaskEmp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_id', 'reciever_id', 'register_id', 'appeal_id', 'status'], 'integer'],
            [['deadtime', 'task', 'letter', 'created', 'updated'], 'safe'],
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
        $query = TaskEmp::find();

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
            'sender_id' => $this->sender_id,
            'reciever_id' => $this->reciever_id,
            'register_id' => $this->register_id,
            'appeal_id' => $this->appeal_id,
            'deadtime' => $this->deadtime,
            'created' => $this->created,
            'updated' => $this->updated,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'task', $this->task])
            ->andFilterWhere(['like', 'letter', $this->letter]);

        return $dataProvider;
    }
}
