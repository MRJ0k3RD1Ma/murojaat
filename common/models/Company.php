<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $inn
 * @property string $name
 * @property string|null $director
 * @property string|null $phone
 * @property string|null $telegram
 * @property string|null $phone_director
 * @property int|null $type_id
 * @property int $soato_id
 * @property int|null $status_id
 * @property string|null $created
 * @property string|null $updated
 * @property string|null $address
 * @property string|null $location
 * @property string|null $lat
 * @property string|null $long
 * @property int|null $parent_id
 * @property string|null $ads
 * @property string|null $cadastre
 *
 * @property Soato $soato
 * @property CompanyStatus $status
 * @property CompanyType $type
 * @property User[] $users
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
            [['type_id', 'soato_id', 'status_id', 'parent_id'], 'integer'],
            [['soato_id'], 'required'],
            [['created', 'updated'], 'safe'],
            [['location', 'ads'], 'string'],
            [['inn', 'name', 'director', 'phone', 'telegram', 'phone_director', 'address', 'lat', 'long', 'cadastre'], 'string', 'max' => 255],
            [['inn'], 'unique'],
            [['soato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::class, 'targetAttribute' => ['soato_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyType::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inn' => 'STIR(INN)',
            'name' => 'Nomi',
            'director' => 'Direktor',
            'phone' => 'Telefon',
            'telegram' => 'Telegram',
            'phone_director' => 'Direktor telefoni',
            'type_id' => 'Tashkilot turi',
            'soato_id' => 'Manzil',
            'status_id' => 'Status',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'address' => 'Manzil',
            'location' => 'Location',
            'lat' => 'Lat',
            'long' => 'Long',
            'parent_id' => 'Yuqori turuvchi tashkiloti',
            'ads' => 'Izoh',
            'cadastre' => 'Kadastr raqami',
        ];
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(CompanyStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(CompanyType::class, ['id' => 'type_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['company_id' => 'id']);
    }

    public function getFulladdr(){
        $ad = $this->soato;
        return Soato::findOne($ad->res_id.$ad->region_id)->name_lot.' '.
            Soato::findOne($ad->res_id.$ad->region_id.$ad->district_id)->name_lot;
    }
    public function getParent(){
        return $this->hasOne(Company::className(),['id'=>'parent_id']);
    }
    public function getChild(){
        return $this->hasMany(Company::className(),['parent_id'=>'id']);
    }
}
