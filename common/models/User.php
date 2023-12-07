<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $role_id
 * @property int|null $company_id
 * @property int $lavozim_id
 * @property int $bulim_id
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
 * @property UserAccesItem $userAccesItem
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $access,$cnt,$cnt_0,$cnt_1,$cnt_2,$cnt_3,$cnt_4,$cnt_5,$bulim_name,$lavozim_name,$cnt_6,$cnt_7,$cnt_8,$cnt_9,$cnt_10,$cnt_11,$cnt_nazorat,$cnt_dead,$cnt_done_dead;
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
            [['role_id', 'lavozim_id', 'bulim_id'], 'required'],
            [['password'],'required','on'=>'insert'],
            [['password','username',],'required','on'=>'change'],
            [['role_id', 'company_id', 'lavozim_id', 'bulim_id', 'status', 'active'], 'integer'],
            [['created', 'updated'], 'safe'],
            ['access','each','rule'=>['integer']],
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
            'role_id' => 'Rol',
            'company_id' => 'Tashkilot',
            'lavozim_id' => 'Lavozim',
            'bulim_id' => 'Bo`lim',
            'name' => 'FIO',
            'image' => 'Rasm',
            'username' => 'Login',
            'password' => 'Parol',
            'phone' => 'Telefon',
            'auth_key' => 'Auth Key',
            'token' => 'Token',
            'email' => 'Email',
            'access' => '',
            'status' => 'Status',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'telegram' => 'Telegram',
            'telegram_username' => 'Telegram Username',
            'telegram_chat_id' => 'Telegram Chat ID',
            'sms_code' => 'Sms Code',
            'active' => 'Active',
            'cnt'=>'Жами',
            'cnt_0'=>'Кўрилмаган',
            'cnt_1'=>'Янги',
            'cnt_2'=>'Жараёнда',
            'cnt_3'=>'Тасдиқланиши кутилмоқда',
            'cnt_4'=>'Бажарилган',
            'cnt_5'=>'Натижаси Рад этилган',
            'cnt_6'=>'Ижобий хал этилди',
            'cnt_7'=>'Чоралар кўрилди',
            'cnt_8'=>'Тушунтирилди',
            'cnt_9'=>'Мурожаат рад этилган',
            'cnt_10'=>'Маълумот учун',
            'cnt_11'=>'Кўрмасдан қолдирилди',
//            $cnt_dead,$cnt_done_dead
            'cnt_dead'=>'Муддати ўтган',
            'cnt_done_dead'=>'Муддати ўтиб ёпилган',
            'cnt_nazorat'=>'Назоратга олинган',
            'bulim_name'=>'Бўлим',
            'lavozim_name'=>'Лавозим',
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

    public function access($type){
        if(UserAccesItem::findOne(['user_id'=>$this->id,'access_id'=>$type])){
            return true;
        }else{
            return false;
        }
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

    public function getLavozim(){
        return $this->hasOne(Lavozim::class,['id'=>'lavozim_id']);
    }

    public function getBulim(){
        return $this->hasOne(Bulim::class,['id'=>'bulim_id']);
    }
    /**
     * Gets query for [[UserAccesItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAccesItem()
    {
        return $this->hasOne(UserAccesItem::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, /*'status' => self::STATUS_ACTIVE*/]);
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
        return static::findOne(['username' => $username,/* 'status' => self::STATUS_ACTIVE*/]);
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
            'token' => $token,
//            'status' => self::STATUS_ACTIVE,
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
            'token' => $token,
//            'status' => self::STATUS_INACTIVE
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
        $this->token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->token = null;
    }
}
