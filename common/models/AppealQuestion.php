<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal_question".
 *
 * @property int $id
 * @property int $group_id
 * @property string $code
 * @property string $name
 *
 * @property AppealRegister[] $appealRegisters
 * @property Appeal[] $appeals
 * @property AppealQuestionGroup $group
 */
class AppealQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'code', 'name'], 'required'],
            [['group_id'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealQuestionGroup::class, 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Гуруҳи',
            'code' => 'Код',
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
        return $this->hasMany(AppealRegister::class, ['question_id' => 'id']);
    }

    /**
     * Gets query for [[Appeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeals()
    {
        return $this->hasMany(Appeal::class, ['question_id' => 'id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(AppealQuestionGroup::class, ['id' => 'group_id']);
    }
}
