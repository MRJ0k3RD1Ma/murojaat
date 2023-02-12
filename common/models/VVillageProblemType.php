<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_village_problem_type".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $group_id
 *
 * @property VProblemGroup $group
 */
class VVillageProblemType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_village_problem_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'group_id'], 'required'],
            [['group_id'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => VProblemGroup::class, 'targetAttribute' => ['group_id' => 'id']],
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
            'group_id' => 'Group ID',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(VProblemGroup::class, ['id' => 'group_id']);
    }
}
