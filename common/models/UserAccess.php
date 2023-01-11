<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_access".
 *
 * @property int $id
 * @property string $name
 * @property string|null $url
 *
 * @property UserAccesItem[] $userAccesItems
 * @property User[] $users
 */
class UserAccess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
        ];
    }

    /**
     * Gets query for [[UserAccesItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAccesItems()
    {
        return $this->hasMany(UserAccesItem::class, ['access_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('user_acces_item', ['access_id' => 'id']);
    }
}
