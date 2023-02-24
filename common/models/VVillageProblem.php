<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_village_problem".
 *
 * @property int $id
 * @property int $village_id
 * @property string $kinship
 * @property int $year
 * @property string|null $name
 * @property string $detail
 * @property int|null $type_id
 * @property int $status_id
 * @property int $ranges
 *
 * @property VAppeal[] $vAppeals
 * @property VAppeal[] $vAppeals0
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
            [['id', 'village_id', 'year', 'type_id', 'status_id', 'ranges'], 'integer'],
            [['detail'], 'string'],
            [['kinship', 'name'], 'string', 'max' => 255],
            [['id', 'village_id'], 'unique', 'targetAttribute' => ['id', 'village_id']],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => VVillage::className(), 'targetAttribute' => ['village_id' => 'id']],
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
            'kinship' => 'Қариндошлиги',
            'year' => 'Туғилган йили',
            'name' => 'ФИО',
            'detail' => 'Муаммо матни',
            'type_id' => 'Муаммо коди',
            'status_id' => 'Ҳолати',
            'ranges' => 'Муаммо даражаси',
        ];
    }

    /**
     * Gets query for [[VAppeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVAppeals()
    {
        return $this->hasMany(VAppeal::className(), ['problem_id' => 'id']);
    }

    /**
     * Gets query for [[VAppeals0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVAppeals0()
    {
        return $this->hasMany(VAppeal::className(), ['village_id' => 'village_id']);
    }

    /**
     * Gets query for [[Village]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVillage()
    {
        return $this->hasOne(VVillage::className(), ['id' => 'village_id']);
    }

    public function getType(){
        return $this->hasOne(VVillageProblemType::class,['id'=>'type_id']);
    }

    public function getStatus(){
        return $this->hasOne(VVillageProblemStatus::class,['id'=>'status_id']);
    }
}
