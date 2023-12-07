<?php

namespace common\models\search;

use common\models\User;
use yii\data\ActiveDataProvider;
use Yii;
/**
 * TaskEmpSearch represents the model behind the search form of `common\models\TaskEmp`.
 */
class ReportSearch extends User
{
    /**
     * {@inheritdoc}
     */
    /*public function rules()
    {
        return [
            [['id', 'name', 'register_id', 'appeal_id', 'status'], 'integer'],
            [['deadtime', 'task', 'letter', 'created', 'updated'], 'safe'],
        ];
    }*/


    public function searchLeader($params)
    {
        $query = User::find()->select([
            'user.id','user.name','bulim.name as bulim_name','lavozim.name as lavozim_name',
            '(SELECT COUNT(*) FROM appeal_register WHERE appeal_register.rahbar_id=user.id ) AS cnt',
            '(SELECT COUNT(*) FROM appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.status = 0) as cnt_0',
            '(SELECT COUNT(*) FROM appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.status = 1) AS cnt_1',
            '(SELECT COUNT(*) FROM appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.status = 2) AS cnt_2',
            '(SELECT COUNT(*) FROM appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.status = 3) AS cnt_3',
            '(SELECT COUNT(*) FROM appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.status = 4) AS cnt_4',
            '(SELECT COUNT(*) FROM appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.status = 5) AS cnt_5',
			//'(SELECT COUNT(*) FROM task_emp WHERE task_emp.reciever_id=user.id  and appeal.appeal_control_id=2) AS cnt_5',
            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id <> 0) as cnt_nazorat',
            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 2) as cnt_6',
            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 3) as cnt_7',
            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 4) as cnt_8',
            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 5) as cnt_9',
            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 6) as cnt_10',
            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.control_id = 7) as cnt_11',
            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.status = 2 and deadtime<date(now())) as cnt_dead',
            '(select count(*) from appeal_register WHERE appeal_register.rahbar_id=user.id and appeal_register.status = 4 and deadtime<donetime ) as cnt_done_dead',
            // muddati o'tib yopilgan
            // muddati o'tgan  AppealRegister::find()->andWhere(['<>','status',4])->andWhere("deadtime<date(now())")->count('id')

            ])
            ->leftJoin('bulim','bulim.id = user.bulim_id')
            ->leftJoin('lavozim','lavozim.id=user.lavozim_id')
            ->innerJoin('user_acces_item','user_acces_item.user_id = user.id and user_acces_item.access_id=1')
            ->where(['user.company_id'=>Yii::$app->user->identity->company_id])
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
