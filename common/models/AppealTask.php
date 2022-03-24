<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal_task".
 *
 * @property int $id
 * @property int $appeal_id
 * @property int $sender_id
 * @property int $reciever_id
 * @property string|null $number_full
 * @property string|null $task
 * @property string|null $task_file
 * @property string|null $deadline
 * @property int $status_id
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Appeal $appeal
 * @property TaskStatus $status
 */
class AppealTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appeal_id', 'sender_id', 'reciever_id'], 'required'],
            [['appeal_id', 'sender_id', 'reciever_id', 'status_id'], 'integer'],
            [['deadline', 'created', 'updated'], 'safe'],
            [['number_full', 'task_file'], 'string', 'max' => 60],
            [['task'], 'string', 'max' => 500],
            [['appeal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appeal::className(), 'targetAttribute' => ['appeal_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'appeal_id' => 'Appeal ID',
            'sender_id' => 'Sender ID',
            'reciever_id' => 'Reciever ID',
            'number_full' => 'Number Full',
            'task' => 'Task',
            'task_file' => 'Task File',
            'deadline' => 'Deadline',
            'status_id' => 'Status ID',
            'created' => 'Created',
            'updated' => 'Updated',
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TaskStatus::className(), ['id' => 'status_id']);
    }
}
