<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_village".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $sector
 * @property int|null $soato_id
 * @property string|null $date
 * @property string|null $road
 * @property string|null $address
 * @property string|null $person_name
 * @property string|null $person_birthday
 * @property int|null $has_cl_problem
 * @property int|null $want_econom_energy
 * @property string|null $econom_energy_credit
 * @property string|null $econom_energy_own
 * @property string|null $econom_energy
 * @property int|null $want_credit
 * @property string|null $credit
 * @property int|null $credit_women
 * @property int|null $credit_young
 * @property int|null $want_subsidy
 * @property int|null $subsidy_women
 * @property int|null $subsidy_young
 * @property string|null $subsidy
 * @property string|null $person_phone
 * @property int|null $migrant
 * @property int|null $home_status_id
 *
 * @property VHomeStatus $homeStatus
 * @property Soato $soato
 * @property User $user
 * @property VPersonMigrant[] $vPersonMigrants
 * @property VVillageProblem[] $vVillageProblems
 */
class VVillage extends \yii\db\ActiveRecord
{
    public $mig,$problems;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_village';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'sector', 'soato_id', 'has_cl_problem', 'want_econom_energy', 'want_credit', 'credit_women', 'credit_young', 'want_subsidy', 'subsidy_women', 'subsidy_young', 'migrant', 'home_status_id'], 'integer'],
            [['date', 'person_birthday','created','updated','mig','problems'], 'safe'],
            [['road', 'address', 'person_name', 'econom_energy_credit','person_phone', 'econom_energy_own', 'econom_energy', 'credit', 'subsidy'], 'string', 'max' => 255],
            [['home_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => VHomeStatus::class, 'targetAttribute' => ['home_status_id' => 'id']],
            [['soato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::class, 'targetAttribute' => ['soato_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'sector' => 'Сектор',
            'soato_id' => 'Манзил',
            'date' => 'Сўровнома санаси',
            'road' => 'Кўча',
            'address' => 'Манзил',
            'person_name' => 'ФИО',
            'person_phone' => 'Телефон рақами',
            'person_birthday' => 'Туғилган санаси',
            'has_cl_problem' => 'Назоратга олинадиган муаммоси бор хонадонми ',
            'want_econom_energy' => 'Энергия тежамкор ускуналар ўрнатишга эҳтиёжи  ',
            'econom_energy_credit' => '',
            'econom_energy_own' => '',
            'econom_energy' => 'кВт',
            'want_credit' => 'Кредит олишга бўлган талаб (млн.сўмда)',
            'credit' => 'Кредит мақсади:',
            'credit_women' => 'Аёллар',
            'credit_young' => 'Ёшлар',
            'want_subsidy' => 'Субсидия олишга бўлган талаб:',
            'subsidy_women' => 'Аёллар',
            'subsidy_young' => 'Ёшлар',
            'subsidy' => 'Субсидия мақсади:',
            'migrant' => 'Хонадон вакилидан четда (ишлаш ёки ўқиш мақсадида) юрганлар сони',
            'home_status_id' => 'Хонадоннинг иқтисодий-ижтимоий аҳволи:',
        ];
    }

    /**
     * Gets query for [[HomeStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHomeStatus()
    {
        return $this->hasOne(VHomeStatus::class, ['id' => 'home_status_id']);
    }

    /**
     * Gets query for [[Soato]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoato()
    {
        return $this->hasOne(Soato::class, ['id' => 'soato_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[VPersonMigrants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVPersonMigrants()
    {
        return $this->hasMany(VPersonMigrant::class, ['village_id' => 'id']);
    }

    /**
     * Gets query for [[VVillageProblems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVVillageProblems()
    {
        return $this->hasMany(VVillageProblem::class, ['village_id' => 'id']);
    }
}
