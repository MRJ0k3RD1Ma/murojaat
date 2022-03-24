<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "register".
 *
 * @property int $id
 * @property int|null $number
 * @property string $number_full
 * @property int|null $appeal_id
 * @property string|null $date
 * @property int $rahbar_id
 * @property int $send_id
 * @property string|null $deadtime
 * @property string|null $donetime
 * @property int $control_id
 * @property int|null $status_id
 * @property int $controlled
 * @property int|null $is_repeat
 * @property string|null $repeat_number
 * @property string|null $repeat_date
 * @property string|null $created
 * @property string|null $updated
 * @property int $question_id
 *
 * @property Appeal $appeal
 * @property AppealControl $control
 * @property AppealQuestion $question
 * @property User $rahbar
 * @property AppealSend $send
 * @property AppealStatus $status
 */
class Register extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'register';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'appeal_id', 'rahbar_id', 'send_id', 'control_id', 'status_id', 'controlled', 'is_repeat', 'question_id'], 'integer'],
            [['date', 'deadtime', 'donetime', 'repeat_date', 'created', 'updated'], 'safe'],
            [['rahbar_id', 'send_id', 'question_id'], 'required'],
            [['number_full', 'repeat_number'], 'string', 'max' => 255],
            [['appeal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appeal::className(), 'targetAttribute' => ['appeal_id' => 'id']],
            [['control_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealControl::className(), 'targetAttribute' => ['control_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealQuestion::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['rahbar_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['rahbar_id' => 'id']],
            [['send_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealSend::className(), 'targetAttribute' => ['send_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'number_full' => 'Number Full',
            'appeal_id' => 'Appeal ID',
            'date' => 'Date',
            'rahbar_id' => 'Rahbar ID',
            'send_id' => 'Send ID',
            'deadtime' => 'Deadtime',
            'donetime' => 'Donetime',
            'control_id' => 'Control ID',
            'status_id' => 'Status ID',
            'controlled' => 'Controlled',
            'is_repeat' => 'Is Repeat',
            'repeat_number' => 'Repeat Number',
            'repeat_date' => 'Repeat Date',
            'created' => 'Created',
            'updated' => 'Updated',
            'question_id' => 'Question ID',
        ];
    }

    /**
     * Gets query for [[Appeal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeal()
    {
        return $this->hasOne(Appeal::className(), ['id' => 'appeal_id']);
    }

    /**
     * Gets query for [[Control]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControl()
    {
        return $this->hasOne(AppealControl::className(), ['id' => 'control_id']);
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(AppealQuestion::className(), ['id' => 'question_id']);
    }

    /**
     * Gets query for [[Rahbar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRahbar()
    {
        return $this->hasOne(User::className(), ['id' => 'rahbar_id']);
    }

    /**
     * Gets query for [[Send]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSend()
    {
        return $this->hasOne(AppealSend::className(), ['id' => 'send_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(AppealStatus::className(), ['id' => 'status_id']);
    }
}
