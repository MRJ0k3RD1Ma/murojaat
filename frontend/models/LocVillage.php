<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loc_village".
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
 */
class LocVillage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loc_village';
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
}
