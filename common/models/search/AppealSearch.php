<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Appeal;

/**
 * AppealSearch represents the model behind the search form of `common\models\Appeal`.
 */
class AppealSearch extends Appeal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pursuit', 'person_id', 'gender', 'soato_id', 'isbusinessman', 'question_id', 'appeal_type_id', 'appeal_shakl_id', 'appeal_control_id', 'count_applicant', 'count_list', 'status', 'boshqa_tashkilot', 'boshqa_tashkilot_id', 'answer_reply_send', 'company_id', 'register_id', 'register_company_id', 'type', 'number', 'year', 'employment_id'], 'integer'],
            [['passport', 'passport_jshshir', 'person_name', 'person_phone', 'date_of_birth', 'address', 'email', 'businessman', 'appeal_preview', 'appeal_detail', 'appeal_file', 'executor_files', 'appeal_file_extension', 'deadtime', 'created', 'updated', 'boshqa_tashkilot_number', 'boshqa_tashkilot_date', 'answer_name', 'answer_file', 'answer_preview', 'answer_detail', 'answer_number', 'answer_date', 'number_full'], 'safe'],
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
        $query = Appeal::find();

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
            'pursuit' => $this->pursuit,
            'person_id' => $this->person_id,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'soato_id' => $this->soato_id,
            'isbusinessman' => $this->isbusinessman,
            'question_id' => $this->question_id,
            'appeal_type_id' => $this->appeal_type_id,
            'appeal_shakl_id' => $this->appeal_shakl_id,
            'appeal_control_id' => $this->appeal_control_id,
            'count_applicant' => $this->count_applicant,
            'count_list' => $this->count_list,
            'status' => $this->status,
            'deadtime' => $this->deadtime,
            'created' => $this->created,
            'updated' => $this->updated,
            'boshqa_tashkilot' => $this->boshqa_tashkilot,
            'boshqa_tashkilot_date' => $this->boshqa_tashkilot_date,
            'boshqa_tashkilot_id' => $this->boshqa_tashkilot_id,
            'answer_reply_send' => $this->answer_reply_send,
            'answer_date' => $this->answer_date,
            'company_id' => $this->company_id,
            'register_id' => $this->register_id,
            'register_company_id' => $this->register_company_id,
            'type' => $this->type,
            'number' => $this->number,
            'year' => $this->year,
            'employment_id' => $this->employment_id,
        ]);

        $query->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['like', 'passport_jshshir', $this->passport_jshshir])
            ->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'businessman', $this->businessman])
            ->andFilterWhere(['like', 'appeal_preview', $this->appeal_preview])
            ->andFilterWhere(['like', 'appeal_detail', $this->appeal_detail])
            ->andFilterWhere(['like', 'appeal_file', $this->appeal_file])
            ->andFilterWhere(['like', 'executor_files', $this->executor_files])
            ->andFilterWhere(['like', 'appeal_file_extension', $this->appeal_file_extension])
            ->andFilterWhere(['like', 'boshqa_tashkilot_number', $this->boshqa_tashkilot_number])
            ->andFilterWhere(['like', 'answer_name', $this->answer_name])
            ->andFilterWhere(['like', 'answer_file', $this->answer_file])
            ->andFilterWhere(['like', 'answer_preview', $this->answer_preview])
            ->andFilterWhere(['like', 'answer_detail', $this->answer_detail])
            ->andFilterWhere(['like', 'answer_number', $this->answer_number])
            ->andFilterWhere(['like', 'number_full', $this->number_full]);

        return $dataProvider;
    }
    public function searchVillage($params)
    {
        $query = Appeal::find()->where(['register_company_id'=>\Yii::$app->user->identity->company_id])->orderBy(['created'=>SORT_DESC]);

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
            'pursuit' => $this->pursuit,
            'person_id' => $this->person_id,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'region_id' => $this->region_id,
            'district_id' => $this->district_id,
            'isbusinessman' => $this->isbusinessman,
            'question_id' => $this->question_id,
            'appeal_type_id' => $this->appeal_type_id,
            'appeal_shakl_id' => $this->appeal_shakl_id,
            'appeal_control_id' => $this->appeal_control_id,
            'count_applicant' => $this->count_applicant,
            'count_list' => $this->count_list,
            'status' => $this->status,
            'deadtime' => $this->deadtime,
            'created' => $this->created,
            'updated' => $this->updated,
            'boshqa_tashkilot' => $this->boshqa_tashkilot,
            'boshqa_tashkilot_date' => $this->boshqa_tashkilot_date,
            'boshqa_tashkilot_id' => $this->boshqa_tashkilot_id,
            'answer_reply_send' => $this->answer_reply_send,
            'answer_date' => $this->answer_date,
            'company_id' => $this->company_id,
        ]);

        $query->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['like', 'passport_jshshir', $this->passport_jshshir])
            ->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'businessman', $this->businessman])
            ->andFilterWhere(['like', 'appeal_preview', $this->appeal_preview])
            ->andFilterWhere(['like', 'appeal_detail', $this->appeal_detail])
            ->andFilterWhere(['like', 'appeal_file', $this->appeal_file])
            ->andFilterWhere(['like', 'executor_files', $this->executor_files])
            ->andFilterWhere(['like', 'appeal_file_extension', $this->appeal_file_extension])
            ->andFilterWhere(['like', 'boshqa_tashkilot_number', $this->boshqa_tashkilot_number])
            ->andFilterWhere(['like', 'answer_name', $this->answer_name])
            ->andFilterWhere(['like', 'answer_file', $this->answer_file])
            ->andFilterWhere(['like', 'answer_preview', $this->answer_preview])
            ->andFilterWhere(['like', 'answer_detail', $this->answer_detail])
            ->andFilterWhere(['like', 'answer_number', $this->answer_number]);

        return $dataProvider;
    }
    public function searchNotreg($params)
    {
        $query = Appeal::find()->where(['type'=>1])->andWhere(['<','status',2])->orderBy(['created'=>SORT_DESC]);

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
            'pursuit' => $this->pursuit,
            'person_id' => $this->person_id,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'region_id' => $this->region_id,
            'district_id' => $this->district_id,
            'isbusinessman' => $this->isbusinessman,
            'question_id' => $this->question_id,
            'appeal_type_id' => $this->appeal_type_id,
            'appeal_shakl_id' => $this->appeal_shakl_id,
            'appeal_control_id' => $this->appeal_control_id,
            'count_applicant' => $this->count_applicant,
            'count_list' => $this->count_list,
            'status' => $this->status,
            'deadtime' => $this->deadtime,
            'created' => $this->created,
            'updated' => $this->updated,
            'boshqa_tashkilot' => $this->boshqa_tashkilot,
            'boshqa_tashkilot_date' => $this->boshqa_tashkilot_date,
            'boshqa_tashkilot_id' => $this->boshqa_tashkilot_id,
            'answer_reply_send' => $this->answer_reply_send,
            'answer_date' => $this->answer_date,
            'company_id' => $this->company_id,
        ]);

        $query->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['like', 'passport_jshshir', $this->passport_jshshir])
            ->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'businessman', $this->businessman])
            ->andFilterWhere(['like', 'appeal_preview', $this->appeal_preview])
            ->andFilterWhere(['like', 'appeal_detail', $this->appeal_detail])
            ->andFilterWhere(['like', 'appeal_file', $this->appeal_file])
            ->andFilterWhere(['like', 'executor_files', $this->executor_files])
            ->andFilterWhere(['like', 'appeal_file_extension', $this->appeal_file_extension])
            ->andFilterWhere(['like', 'boshqa_tashkilot_number', $this->boshqa_tashkilot_number])
            ->andFilterWhere(['like', 'answer_name', $this->answer_name])
            ->andFilterWhere(['like', 'answer_file', $this->answer_file])
            ->andFilterWhere(['like', 'answer_preview', $this->answer_preview])
            ->andFilterWhere(['like', 'answer_detail', $this->answer_detail])
            ->andFilterWhere(['like', 'answer_number', $this->answer_number]);

        return $dataProvider;
    }
}
