<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $inn
 * @property string $password
 * @property string $name
 * @property string $director
 * @property string $phone
 * @property string $telegram
 * @property string|null $active_to
 * @property string|null $active_each
 * @property string $created
 * @property string $updated
 * @property int $status
 * @property int $management
 * @property int $type_id
 * @property int $group_id
 * @property int $region_id
 * @property int $district_id
 * @property int $village_id
 * @property string $address
 * @property string $token
 * @property int $paid
 * @property string $paid_date
 *
 * @property AppealSend[] $appealSends
 * @property Appeal[] $appeals
 * @property Appeal[] $appeals0
 * @property LocDistricts $district
 * @property CompanyGroup $group
 * @property LocRegions $region
 * @property CompanyType $type
 * @property LocVillages $village
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inn', 'password', 'name', 'director', 'phone', 'type_id', 'group_id', 'region_id', 'district_id', 'village_id', 'address'], 'required'],
            [['active_to', 'active_each', 'created', 'updated', 'paid_date'], 'safe'],
            [['status', 'management', 'type_id', 'group_id', 'region_id', 'district_id', 'village_id', 'paid'], 'integer'],
            [['inn', 'name', 'director', 'phone', 'telegram', 'address', 'token'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 500],
            [['inn'], 'unique'],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocDistricts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocRegions::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocVillages::className(), 'targetAttribute' => ['village_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inn' => 'Inn',
            'password' => 'Password',
            'name' => 'Name',
            'director' => 'Director',
            'phone' => 'Phone',
            'telegram' => 'Telegram',
            'active_to' => 'Active To',
            'active_each' => 'Active Each',
            'created' => 'Created',
            'updated' => 'Updated',
            'status' => 'Status',
            'management' => 'Management',
            'type_id' => 'Type ID',
            'group_id' => 'Group ID',
            'region_id' => 'Region ID',
            'district_id' => 'District ID',
            'village_id' => 'Village ID',
            'address' => 'Address',
            'token' => 'Token',
            'paid' => 'Paid',
            'paid_date' => 'Paid Date',
        ];
    }

    /**
     * Gets query for [[AppealSends]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealSends()
    {
        return $this->hasMany(AppealSend::className(), ['company_id' => 'id']);
    }

    /**
     * Gets query for [[Appeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeals()
    {
        return $this->hasMany(Appeal::className(), ['company_id' => 'id']);
    }

    /**
     * Gets query for [[Appeals0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeals0()
    {
        return $this->hasMany(Appeal::className(), ['id' => 'appeal_id'])->viaTable('appeal_send', ['company_id' => 'id']);
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(LocDistricts::className(), ['id' => 'district_id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(CompanyGroup::className(), ['id' => 'group_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(LocRegions::className(), ['id' => 'region_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(CompanyType::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[Village]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVillage()
    {
        return $this->hasOne(LocVillages::className(), ['id' => 'village_id']);
    }
}
