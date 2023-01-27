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
 * @property int $paid
 * @property string|null $paid_date
 *
 * @property Soato $soato
 * @property CompanyStatus $status
 * @property CompanyType $type
 * @property User[] $users
 */
class Company extends \yii\db\ActiveRecord
{
    public $cntall,$cntzero,$cntone,$cnttwo,$cnttree,$cntfour,$cntdead,$cntwithdead,$cnt0,$cnt1,$cnt2,$cnt3,$cnt4,$cnt5,$redirect;
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
            [['type_id', 'soato_id', 'status_id', 'parent_id','paid'], 'integer'],
            [['soato_id'], 'required'],
            [['created', 'updated','paid_date'], 'safe'],
            [['location', 'ads','cadastre'], 'string'],
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
            'inn' => 'СТИР(ИНН)',
            'name' => 'Номи',
            'director' => 'Директор',
            'phone' => 'Телефон',
            'telegram' => 'Телеграм',
            'phone_director' => 'Директор телефони',
            'type_id' => 'Ташкилот тури',
            'soato_id' => 'Манзид',
            'status_id' => 'Статус',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'address' => 'Манзил',
            'location' => 'Location',
            'lat' => 'Lat',
            'long' => 'Long',
            'parent_id' => 'Юқори турувчи ташкилот',
            'ads' => 'Изоҳ',
            'cadastre' => 'Кадастр рақами',
            'cntall' => 'Юборилган мурожаатлар',
            'cntzero' => 'Қабул қилинмаган',
            'cntone' => 'Жараёнда',
            'cnttwo' => 'Бажарилган',
            'cntdead' => 'Муддати бузилган',
            'cntwithdead' => 'Муддати бузилиб бажарилган',
            'cnt0' => 'Кўрилмаган',
            'cnt1' => 'Янги',
            'cnt2' => 'Жараёнда',
            'cnt3' => 'Тасдиқланиши кутилмоқда',
            'cnt4' => 'Бажарилган',
            'cnt5' => 'Рад этилган',
            'paid' => 'Тўланган',
            'paid_date' => 'Тўлов санаси',
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
