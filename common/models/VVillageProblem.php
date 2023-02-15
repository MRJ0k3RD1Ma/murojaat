<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_village_problem".
 *
 * @property int $id
 * @property int $village_id
 * @property int $type_id
 * @property int $status_id
 * @property string $kinship
 * @property int $year
 * @property string|null $name
 * @property string $detail
 *
 * @property VVillage $village
 */
class VVillageProblem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_village_problem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'village_id', 'year'], 'required'],
            [['id', 'village_id', 'year','status_id','type_id'], 'integer'],
            [['detail'], 'string'],
            [['kinship', 'name'], 'string', 'max' => 255],
            [['id', 'village_id'], 'unique', 'targetAttribute' => ['id', 'village_id']],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => VVillage::class, 'targetAttribute' => ['village_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'village_id' => 'Village ID',
            'kinship' => 'Kinship',
            'year' => 'Year',
            'name' => 'Name',
            'detail' => 'Detail',
        ];
    }

    /**
     * Gets query for [[Village]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVillage()
    {
        return $this->hasOne(VVillage::class, ['id' => 'village_id']);
    }
}
