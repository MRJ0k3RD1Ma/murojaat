<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_acces_item".
 *
 * @property int $user_id
 * @property int $access_id
 * @property int|null $status
 *
 * @property UserAccess $access
 * @property User $user
 */
class UserAccesItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_acces_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'access_id'], 'required'],
            [['user_id', 'access_id', 'status'], 'integer'],
            [['user_id', 'access_id'], 'unique', 'targetAttribute' => ['user_id', 'access_id']],
            [['access_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccess::class, 'targetAttribute' => ['access_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'access_id' => 'Access ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Access]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccess()
    {
        return $this->hasOne(UserAccess::class, ['id' => 'access_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
