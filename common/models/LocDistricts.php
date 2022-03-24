<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "loc_districts".
 *
 * @property int $id
 * @property string $name
 * @property int $region_id
 * @property string|null $svg_map
 * @property int $sort
 *
 * @property Appeal[] $appeals
 * @property Company[] $companies
 * @property LocVillages[] $locVillages
 * @property LocRegions $region
 */
class LocDistricts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loc_districts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id'], 'required'],
            [['region_id', 'sort'], 'integer'],
            [['svg_map'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocRegions::className(), 'targetAttribute' => ['region_id' => 'id']],
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
            'region_id' => 'Region ID',
            'svg_map' => 'Svg Map',
            'sort' => 'Sort',
        ];
    }

    /**
     * Gets query for [[Appeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeals()
    {
        return $this->hasMany(Appeal::className(), ['district_id' => 'id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['district_id' => 'id']);
    }

    /**
     * Gets query for [[LocVillages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocVillages()
    {
        return $this->hasMany(LocVillages::className(), ['district_id' => 'id']);
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
}
