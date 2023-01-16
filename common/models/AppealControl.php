<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal_control".
 *
 * @property int $id
 * @property string $name
 *
 * @property AppealRegister[] $appealRegisters
 */
class AppealControl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_control';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Номи',
        ];
    }

    /**
     * Gets query for [[AppealRegisters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealRegisters()
    {
        return $this->hasMany(AppealRegister::class, ['control_id' => 'id']);
    }
}
