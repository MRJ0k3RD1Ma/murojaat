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
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealQuestionGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
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
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(AppealQuestionGroup::className(), ['id' => 'group_id']);
    }
}
