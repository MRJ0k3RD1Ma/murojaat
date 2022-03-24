<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal".
 *
 * @property int $id
 * @property string $code
 * @property int $number
 * @property string $number_full
 * @property string $name
 * @property int $gender
 * @property string|null $birthday
 * @property int $region_id
 * @property int $district_id
 * @property int|null $village_id
 * @property string $address
 * @property int $employment_id Bandligi
 * @property string|null $business
 * @property int $is_juridical
 * @property string|null $email
 * @property int $type_id
 * @property string|null $file
 * @property string|null $date
 * @property string $detail
 * @property int|null $shakl_id
 * @property int|null $person_id
 * @property int|null $company_id
 * @property string|null $updated
 * @property string|null $created
 * @property int|null $status_id
 * @property int|null $other Boshqa tashkilotdan kelganligi(0-yo'q, 1-Boshqa tashkilot, 2 company_id)
 * @property int|null $other_id appeal_boshqa_tashkilot id yoki company_id
 *
 * @property AppealSend[] $appealSends
 * @property AppealTask[] $appealTasks
 * @property Company[] $companies
 * @property Company $company
 * @property LocDistricts $district
 * @property Employment $employment
 * @property LocRegions $region
 * @property AppealShakl $shakl
 * @property AppealStatus $status
 * @property AppealType $type
 */
class Appeal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'number_full', 'gender','phone', 'region_id', 'district_id','count_page', 'employment_id', 'type_id','date'], 'required'],
            [['number', 'gender', 'region_id', 'district_id', 'village_id', 'employment_id', 'is_juridical', 'type_id', 'shakl_id', 'person_id', 'company_id', 'status_id', 'other', 'other_id'], 'integer'],
            [['birthday', 'updated', 'created'], 'safe'],
            [['detail'], 'string'],
            [['code', 'number_full','phone', 'name','other_number', 'address', 'business', 'file'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
            [['code'], 'unique'],
            [['date','other_date'],'safe'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocDistricts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['employment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employment::className(), 'targetAttribute' => ['employment_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocRegions::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['shakl_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealShakl::className(), 'targetAttribute' => ['shakl_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'number' => 'Рақами',
            'date' => 'Санаси',
            'number_full' => 'Рақами',
            'name' => 'ФИО',
            'gender' => 'Жинси',
            'birthday' => 'Туғилган санаси',
            'region_id' => 'Вилоят',
            'district_id' => 'Туман',
            'village_id' => 'Маҳалла',
            'address' => 'Манзил',
            'employment_id' => 'Тоифаси',
            'business' => 'Тадбиркорлик субьекти',
            'is_juridical' => 'Юридик шахс',
            'email' => 'Эл-почта',
            'type_id' => 'Тури',
            'file' => 'Файл',
            'detail' => 'Мурожаат матни',
            'shakl_id' => 'Шакли',
            'person_id' => 'Фуқаро',
            'company_id' => 'Ташкилот',
            'count_page' => 'Варақлар сони',
            'updated' => 'Ўзгартирилди',
            'created' => 'Яратилди',
            'status_id' => 'Статус',
            'other' => 'Бошқа ташкилот',
            'other_id' => 'Ташкилот номи',
            'question_id' => 'Савол',
            'phone' => 'Телефон',
            'other_number' => 'Рақами',
            'other_date' => 'Санаси',
        ];
    }

    /**
     * Gets query for [[AppealSends]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealSends()
    {
        return $this->hasMany(AppealSend::className(), ['appeal_id' => 'id']);
    }

    /**
     * Gets query for [[AppealTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealTasks()
    {
        return $this->hasMany(AppealTask::className(), ['appeal_id' => 'id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['id' => 'company_id'])->viaTable('appeal_send', ['appeal_id' => 'id']);
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
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
     * Gets query for [[Employment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployment()
    {
        return $this->hasOne(Employment::className(), ['id' => 'employment_id']);
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
     * Gets query for [[Shakl]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShakl()
    {
        return $this->hasOne(AppealShakl::className(), ['id' => 'shakl_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(AppealStatus::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(AppealType::className(), ['id' => 'type_id']);
    }
}
