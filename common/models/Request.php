<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $sender_id
 * @property int $reciever_id
 * @property int $type_id
 * @property int $register_id
 * @property int $appeal_id
 * @property int $status_id
 * @property string|null $detail
 * @property string|null $date
 * @property string|null $file
 * @property string $created
 * @property string $updated
 * @property string|null $ignore_ads
 *
 * @property Appeal $appeal
 * @property User $reciever
 * @property AppealRegister $register
 * @property User $sender
 * @property RequestStatus $status
 * @property RequestType $type
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_id', 'reciever_id', 'type_id', 'register_id', 'appeal_id'], 'required'],
            [['sender_id', 'reciever_id', 'type_id', 'register_id', 'appeal_id', 'status_id'], 'integer'],
            [['detail', 'ignore_ads'], 'string'],
            [['date', 'created', 'updated'], 'safe'],
            [['file'], 'string', 'max' => 255],
            [['appeal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appeal::class, 'targetAttribute' => ['appeal_id' => 'id']],
            [['reciever_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['reciever_id' => 'id']],
            [['register_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealRegister::class, 'targetAttribute' => ['register_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['sender_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestType::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender_id' => 'Sender ID',
            'reciever_id' => 'Reciever ID',
            'type_id' => 'Type ID',
            'register_id' => 'Register ID',
            'appeal_id' => 'Appeal ID',
            'status_id' => 'Status ID',
            'detail' => 'Detail',
            'date' => 'Date',
            'file' => 'File',
            'created' => 'Created',
            'updated' => 'Updated',
            'ignore_ads' => 'Ignore Ads',
        ];
    }

    /**
     * Gets query for [[Appeal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeal()
    {
        return $this->hasOne(Appeal::class, ['id' => 'appeal_id']);
    }

    /**
     * Gets query for [[Reciever]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReciever()
    {
        return $this->hasOne(User::class, ['id' => 'reciever_id']);
    }

    /**
     * Gets query for [[Register]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegister()
    {
        return $this->hasOne(AppealRegister::class, ['id' => 'register_id']);
    }

    /**
     * Gets query for [[Sender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::class, ['id' => 'sender_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(RequestStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(RequestType::class, ['id' => 'type_id']);
    }
}
