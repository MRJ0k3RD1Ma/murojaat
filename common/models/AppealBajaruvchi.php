<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "appeal_bajaruvchi".
 *
 * @property int $id
 * @property int $company_id
 * @property int $appeal_id
 * @property int|null $register_id
 * @property int $sender_id
 * @property string $task
 * @property int $deadline
 * @property string $deadtime
 * @property string $created
 * @property int $status
 * @property string|null $letter
 * @property string $updated
 *
 * @property Appeal $appeal
 * @property AppealAnswer[] $appealAnswers
 * @property AppealRegister[] $appealRegisters
 * @property Company $company
 * @property AppealRegister $register
 * @property User $sender
 * @property Status $status0
 */
class AppealBajaruvchi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_bajaruvchi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'appeal_id', 'task', 'deadtime'], 'required'],
            [['company_id', 'appeal_id', 'register_id', 'sender_id', 'deadline', 'status'], 'integer'],
            [['task'], 'string'],
            [['deadtime', 'created', 'updated'], 'safe'],
            [['letter'], 'string', 'max' => 255],
            [['appeal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appeal::class, 'targetAttribute' => ['appeal_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
            [['register_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealRegister::class, 'targetAttribute' => ['register_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['sender_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Ташкилот',
            'appeal_id' => 'Мурожаат',
            'register_id' => 'Мурожаат',
            'sender_id' => 'Юборувчи',
            'task' => 'Топшириқ матни',
            'deadline' => 'Муддат',
            'deadtime' => 'Муддат',
            'created' => 'Юборилди',
            'status' => 'Статус',
            'letter' => 'Файл',
            'updated' => 'Ўзгартирилди',
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

    public function upload(){
        if($this->letter = UploadedFile::getInstance($this,'letter')){
            $name = microtime(true).'.'.$this->letter->extension;
            $this->letter->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
            $this->letter = $name;
        }
    }
    /**
     * Gets query for [[AppealAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealAnswers()
    {
        return $this->hasMany(AppealAnswer::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[AppealRegisters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealRegisters()
    {
        return $this->hasMany(AppealRegister::class, ['parent_bajaruvchi_id' => 'id']);
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
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Status::class, ['id' => 'status']);
    }
}
