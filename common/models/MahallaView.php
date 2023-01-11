<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mahalla_view".
 *
 * @property int $id
 * @property int|null $district_id
 * @property int|null $region_id
 * @property int|null $qfi_id
 * @property int|null $mahalla_id
 * @property string|null $name_lot
 * @property string|null $center_lot
 * @property string|null $name_cyr
 * @property string|null $center_cyr
 * @property string|null $name_ru
 * @property string|null $center_ru
 */
class MahallaView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mahalla_view';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'district_id', 'region_id', 'qfi_id', 'mahalla_id'], 'integer'],
            [['name_lot', 'name_cyr', 'name_ru'], 'string', 'max' => 100],
            [['center_lot', 'center_cyr', 'center_ru'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'district_id' => 'District ID',
            'region_id' => 'Region ID',
            'qfi_id' => 'Qfi ID',
            'mahalla_id' => 'Mahalla ID',
            'name_lot' => 'Name Lot',
            'center_lot' => 'Center Lot',
            'name_cyr' => 'Name Cyr',
            'center_cyr' => 'Center Cyr',
            'name_ru' => 'Name Ru',
            'center_ru' => 'Center Ru',
        ];
    }
}
