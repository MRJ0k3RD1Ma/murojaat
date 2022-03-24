<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "loc_villages".
 *
 * @property int $id
 * @property string $name
 * @property int $district_id
 * @property string|null $svg_map
 * @property string $address Manzil
 * @property string|null $phone MFY tel raqami
 * @property string|null $land_area Umumiy yer maydoni
 * @property int|null $sector_number Sektor raqami
 * @property int|null $sort Ketmaketlik
 *
 * @property Company[] $companies
 * @property LocDistricts $district
 */
class LocVillages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loc_villages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['district_id'], 'required'],
            [['district_id', 'sector_number', 'sort'], 'integer'],
            [['svg_map'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['address', 'phone', 'land_area'], 'string', 'max' => 255],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocDistricts::className(), 'targetAttribute' => ['district_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'district_id' => 'District ID',
            'svg_map' => 'Svg Map',
            'address' => 'Address',
            'phone' => 'Phone',
            'land_area' => 'Land Area',
            'sector_number' => 'Sector Number',
            'sort' => 'Sort',
        ];
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['village_id' => 'id']);
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
}
