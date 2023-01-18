<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "task_emp".
 *
 * @property int $sender_id
 * @property int $reciever_id
 * @property int $register_id
 * @property int $appeal_id
 * @property string $deadtime
 * @property string $task
 * @property string|null $letter
 * @property string $created
 * @property string $updated
 * @property int $status
 *
 * @property Appeal $appeal
 * @property User $reciever
 * @property AppealRegister $register
 * @property User $sender
 */
class TaskEmp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_emp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_id', 'reciever_id', 'register_id', 'appeal_id', 'deadtime', 'task'], 'required'],
            [['sender_id', 'reciever_id', 'register_id', 'appeal_id', 'status'], 'integer'],
            [['deadtime', 'created', 'updated'], 'safe'],
            [['task'], 'string'],
            [['letter'], 'string', 'max' => 255],
            [['sender_id', 'reciever_id', 'register_id', 'appeal_id'], 'unique', 'targetAttribute' => ['sender_id', 'reciever_id', 'register_id', 'appeal_id']],
            [['appeal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appeal::class, 'targetAttribute' => ['appeal_id' => 'id']],
            [['reciever_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['reciever_id' => 'id']],
            [['register_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealRegister::class, 'targetAttribute' => ['register_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['sender_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sender_id' => 'Юбориувчи',
            'reciever_id' => 'Қабул қилувчи',
            'register_id' => 'Мурожаат',
            'appeal_id' => 'Мурожаат',
            'deadtime' => 'Муддат',
            'task' => 'Топшириқ матни',
            'letter' => 'Файл',
            'created' => 'Юборилди',
            'updated' => 'Ўзгартирилди',
            'status' => 'Статус',
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

    public function getStatus0(){
        return $this->hasOne(Status::class,['id'=>'status']);
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
    public function upload(){
        if($this->letter = UploadedFile::getInstance($this,'letter')){
            $name = microtime(true).'.'.$this->letter->extension;
            $this->letter->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
            $this->letter = $name;
        }
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
}
