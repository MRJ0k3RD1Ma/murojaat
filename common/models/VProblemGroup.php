<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_problem_group".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property VVillageProblemType[] $vVillageProblemTypes
 */
class VProblemGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_problem_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
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
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[VVillageProblemTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVVillageProblemTypes()
    {
        return $this->hasMany(VVillageProblemType::class, ['group_id' => 'id']);
    }
}
