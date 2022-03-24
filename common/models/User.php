<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class User extends ActiveRecord implements IdentityInterface
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
            [['role_id', 'name', 'username', 'bulim_id', 'lavozim_id'], 'required'],
            ['password', 'required','on'=>'insert'],
            [['role_id', 'company_id', 'bulim_id', 'lavozim_id', 'is_rahbar', 'is_registration', 'is_resolution','is_control_district', 'is_control', 'is_control_system', 'status', 'active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'image', 'username', 'address'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 500],
            [['phone'], 'string', 'max' => 20],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Фойдаланувчи ҳуқуқи',
            'company_id' => 'Ташкилот',
            'name' => 'ФИО',
            'image' => 'Расм',
            'username' => 'Логинь',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'address' => 'Манзил',
            'bulim_id' => 'Бўлим',
            'lavozim_id' => 'Лавозим',
            'is_rahbar' => 'Раҳар ҳуқуқи',
            'is_control_district' => 'Туман бўйича назорат',
            'is_registration' => 'Регистратор ҳуқуқи',
            'is_resolution' => 'Резалютсия ёзиш  ҳуқуқи',
            'is_control' => 'назорат ҳуқуқи',
            'is_control_system' => 'Вилоят бўйича назорат',
            'created' => 'Created',
            'updated' => 'Updated',
            'status' => 'Status',
            'active' => 'Active',
        ];
    }

    public function getBulim(){
        return $this->hasOne(Bulim::className(),['id'=>'bulim_id']);
    }
    public function getLavozim(){
        return $this->hasOne(Lavozim::className(),['id'=>'lavozim_id']);
    }
    public function encrypt(){
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        return true;
    }
    public function getCompany(){
        return $this->hasOne(Company::className(),['id'=>'company_id']);
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,

        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,

        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
