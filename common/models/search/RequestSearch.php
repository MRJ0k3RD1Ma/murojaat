<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Request;

/**
 * RequestSearch represents the model behind the search form of `common\models\Request`.
 */
class RequestSearch extends Request
{
    public $do;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sender_id', 'reciever_id', 'type_id', 'register_id', 'appeal_id', 'status_id'], 'integer'],
            [['do','detail', 'date', 'file', 'created', 'updated', 'ignore_ads'], 'safe'],
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
        $query = Request::find();

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
            'sender_id' => $this->sender_id,
            'reciever_id' => $this->reciever_id,
            'type_id' => $this->type_id,
            'register_id' => $this->register_id,
            'appeal_id' => $this->appeal_id,
            'status_id' => $this->status_id,
            'date' => $this->date,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'ignore_ads', $this->ignore_ads]);

        return $dataProvider;
    }
}
