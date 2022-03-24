<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "loc_regions".
 *
 * @property int $id
 * @property string $name
 * @property string|null $svg_map
 *
 * @property Appeal[] $appeals
 * @property Company[] $companies
 * @property LocDistricts[] $locDistricts
 */
class LocRegions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loc_regions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['svg_map'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'svg_map' => 'Svg Map',
        ];
    }

    /**
     * Gets query for [[Appeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeals()
    {
        return $this->hasMany(Appeal::className(), ['region_id' => 'id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['region_id' => 'id']);
    }

    /**
     * Gets query for [[LocDistricts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocDistricts()
    {
        return $this->hasMany(LocDistricts::className(), ['region_id' => 'id']);
    }
}
