<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VVillageFives;

/**
 * VVillageFivesSearch represents the model behind the search form of `common\models\VVillageFives`.
 */
class VVillageFivesSearch extends VVillageFives
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id'], 'integer'],
            [['mfy_rais', 'profilaktika_inspektor', 'hokim_yordamchi', 'xotin_qizlar', 'yoshlar_yetakchi', 'deputat'], 'safe'],
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
        $query = VVillageFives::find();

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
        ]);

        $query->andFilterWhere(['like', 'mfy_rais', $this->mfy_rais])
            ->andFilterWhere(['like', 'profilaktika_inspektor', $this->profilaktika_inspektor])
            ->andFilterWhere(['like', 'hokim_yordamchi', $this->hokim_yordamchi])
            ->andFilterWhere(['like', 'xotin_qizlar', $this->xotin_qizlar])
            ->andFilterWhere(['like', 'yoshlar_yetakchi', $this->yoshlar_yetakchi])
            ->andFilterWhere(['like', 'deputat', $this->deputat]);

        return $dataProvider;
    }
}
