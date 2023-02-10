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
            [['date', 'person_birthday'], 'safe'],
            [['road', 'address', 'person_name', 'econom_energy_credit', 'econom_energy_own', 'econom_energy', 'credit', 'subsidy'], 'string', 'max' => 255],
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
            'sector' => 'Sector',
            'soato_id' => 'Soato ID',
            'date' => 'Date',
            'road' => 'Road',
            'address' => 'Address',
            'person_name' => 'Person Name',
            'person_birthday' => 'Person Birthday',
            'has_cl_problem' => 'Has Cl Problem',
            'want_econom_energy' => 'Want Econom Energy',
            'econom_energy_credit' => 'Econom Energy Credit',
            'econom_energy_own' => 'Econom Energy Own',
            'econom_energy' => 'Econom Energy',
            'want_credit' => 'Want Credit',
            'credit' => 'Credit',
            'credit_women' => 'Credit Women',
            'credit_young' => 'Credit Young',
            'want_subsidy' => 'Want Subsidy',
            'subsidy_women' => 'Subsidy Women',
            'subsidy_young' => 'Subsidy Young',
            'subsidy' => 'Subsidy',
            'migrant' => 'Migrant',
            'home_status_id' => 'Home Status ID',
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
