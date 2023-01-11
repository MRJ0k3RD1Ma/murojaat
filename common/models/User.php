<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $role_id
 * @property int|null $company_id
 * @property string $name
 * @property string|null $image
 * @property string $username
 * @property string|null $password
 * @property string|null $phone
 * @property string|null $auth_key
 * @property string|null $token
 * @property string|null $email
 * @property int|null $status
 * @property string|null $created
 * @property string|null $updated
 * @property string|null $telegram
 * @property string|null $telegram_username
 * @property string|null $telegram_chat_id
 * @property string|null $sms_code
 * @property int|null $active
 *
 * @property Company $company
 * @property UserRole $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id','name','username', ], 'required'],
            [['role_id', 'company_id', 'status', 'active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'image', 'username', 'phone', 'auth_key', 'token', 'telegram', 'telegram_username', 'telegram_chat_id', 'sms_code'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 500],
            [['email'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRole::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'image' => 'Image',
            'username' => 'Username',
            'password' => 'Password',
            'phone' => 'Phone',
            'auth_key' => 'Auth Key',
            'token' => 'Token',
            'email' => 'Email',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'telegram' => 'Telegram',
            'telegram_username' => 'Telegram Username',
            'telegram_chat_id' => 'Telegram Chat ID',
            'sms_code' => 'Sms Code',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(UserRole::class, ['id' => 'role_id']);
    }
}
