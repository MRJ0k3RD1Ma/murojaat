<?php

namespace common\models\search;

use common\models\VAppeal;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VVillageProblem;
use Yii;
/**
 * VVillageProblemSearch represents the model behind the search form of `common\models\VVillageProblem`.
 */
class VAppealSearch extends VAppeal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appeal_id', 'id', 'village_id', 'status_id', 'company_id'], 'integer'],
            [['task', 'ignore'], 'safe'],
            [['created', 'updated'], 'safe'],
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
        $query = VAppeal::find()->select(['v_appeal.*'])
            ->innerJoin('v_village','v_village.id=v_appeal.village_id')
            ->where('v_village.soato_id in (select id from mahalla_view where id like "%'.$region_id.'%")')
            ->andWhere(['status_id'=>3])
            ->orderBy(['v_appeal.village_id'=>SORT_DESC])
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


        return $dataProvider;
    }
    
}
