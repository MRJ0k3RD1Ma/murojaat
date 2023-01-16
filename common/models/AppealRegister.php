<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "appeal_register".
 *
 * @property int $id
 * @property string $number
 * @property string $date
 * @property int|null $question_id
 * @property int $appeal_id
 * @property int|null $rahbar_id
 * @property int|null $ijrochi_id
 * @property string|null $users
 * @property string|null $user_answer
 * @property string|null $tashkilot
 * @property string|null $tashkilot_answer
 * @property int|null $parent_bajaruvchi_id
 * @property int $deadline
 * @property string|null $deadtime
 * @property string|null $donetime
 * @property int $control_id
 * @property int $status
 * @property string $created
 * @property string $updated
 * @property int $reply_send
 * @property string|null $preview
 * @property string|null $detail
 * @property string|null $file
 * @property int|null $company_id
 * @property int|null $answer_send
 * @property int $nazorat
 * @property int $takroriy
 * @property int|null $takroriy_id
 * @property string|null $takroriy_date
 * @property string|null $takroriy_number
 *
 * @property Appeal $appeal
 * @property AppealAnswer[] $appealAnswers
 * @property AppealBajaruvchi[] $appealBajaruvchis
 * @property Company $company
 * @property AppealControl $control
 * @property User $ijrochi
 * @property AppealBajaruvchi $parentBajaruvchi
 * @property AppealQuestion $question
 * @property User $rahbar
 * @property Request[] $requests
 * @property TaskEmp[] $taskEmps
 */
class AppealRegister extends \yii\db\ActiveRecord
{
    public $mystatus;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_register';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'date', 'appeal_id'], 'required'],
            [['date', 'deadtime', 'donetime', 'created', 'updated', 'takroriy_date'], 'safe'],
            [['question_id', 'appeal_id', 'rahbar_id', 'ijrochi_id', 'parent_bajaruvchi_id', 'deadline', 'control_id', 'status', 'reply_send', 'company_id', 'answer_send', 'nazorat', 'takroriy', 'takroriy_id'], 'integer'],
            [['users', 'user_answer', 'tashkilot', 'tashkilot_answer', 'detail'], 'string'],
            [['number', 'preview', 'file', 'takroriy_number'], 'string', 'max' => 255],
            [['appeal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appeal::class, 'targetAttribute' => ['appeal_id' => 'id']],
            [['control_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealControl::class, 'targetAttribute' => ['control_id' => 'id']],
            [['ijrochi_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['ijrochi_id' => 'id']],
            [['parent_bajaruvchi_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealBajaruvchi::class, 'targetAttribute' => ['parent_bajaruvchi_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealQuestion::class, 'targetAttribute' => ['question_id' => 'id']],
            [['rahbar_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['rahbar_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Рақами',
            'date' => 'Санаси',
            'question_id' => 'Масаласи',
            'appeal_id' => 'Мурожаат',
            'rahbar_id' => 'Раҳбар',
            'ijrochi_id' => 'Ижрочи',
            'users' => 'Users',
            'user_answer' => 'User Answer',
            'tashkilot' => 'Ташкилот',
            'tashkilot_answer' => 'Tashkilot Answer',
            'parent_bajaruvchi_id' => 'Parent Bajaruvchi ID',
            'deadline' => 'Муддат',
            'deadtime' => 'Муддат',
            'donetime' => 'Бажарилган санаси',
            'control_id' => 'Ҳолати',
            'status' => 'Статус',
            'created' => 'Яратилди',
            'updated' => 'Ўзгарди',
            'reply_send' => 'Жавоб мурожаатчига юборилди',
            'preview' => 'Раҳбар резолюцияси',
            'detail' => 'Detail',
            'file' => 'Файл',
            'company_id' => 'Ташкилот',
            'answer_send' => 'Answer Send',
            'nazorat' => 'Назорат',
            'takroriy' => 'Такрорий',
            'takroriy_id' => 'Такрорий ID',
            'takroriy_date' => 'Санаси',
            'takroriy_number' => 'Рақами',
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
     * Gets query for [[AppealAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealAnswers()
    {
        return $this->hasMany(AppealAnswer::class, ['register_id' => 'id']);
    }

    /**
     * Gets query for [[AppealBajaruvchis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealBajaruvchis()
    {
        return $this->hasMany(AppealBajaruvchi::class, ['register_id' => 'id']);
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
     * Gets query for [[Control]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControl()
    {
        return $this->hasOne(AppealControl::class, ['id' => 'control_id']);
    }

    /**
     * Gets query for [[Ijrochi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIjrochi()
    {
        return $this->hasOne(User::class, ['id' => 'ijrochi_id']);
    }

    /**
     * Gets query for [[ParentBajaruvchi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(AppealBajaruvchi::class, ['id' => 'parent_bajaruvchi_id']);
    }

    public function upload(){

        if($this->letter = UploadedFile::getInstance($this,'letter')){
            $name = microtime(true).'.'.$this->letter->extension;
            $this->letter->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
            $this->letter = $name;
        }

    }

    public function getMyrequest(){
        return $this->hasMany(Request::className(),['register_id'=>'id']);
    }

    public function getChild(){
        return $this->hasMany(AppealBajaruvchi::className(),['register_id'=>'id']);
    }
    public function getAnswer(){
        return $this->hasMany(AppealAnswer::className(),['register_id'=>'id']);
    }
    public function getChildanswer(){
        return AppealAnswer::find()
            ->where('parent_id in (select id from appeal_bajaruvchi where register_id='.$this->id.')')
            ->orderBy(['id'=>SORT_DESC])->all();
    }
    public function getChildanswermy(){
        return AppealAnswer::find()
            ->where('parent_id in (select id from appeal_bajaruvchi where register_id='.$this->id.' and sender_id='.Yii::$app->user->id.')')
            ->orderBy(['id'=>SORT_DESC])->all();
    }


    public function getStatus0(){
        return $this->hasOne(Status::className(),['id'=>'status']);
    }

    public function getChildemp(){
        return $this->hasMany(TaskEmp::className(),['register_id'=>'id'])->orderBy(['created'=>SORT_DESC]);
    }
    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(AppealQuestion::class, ['id' => 'question_id']);
    }

    /**
     * Gets query for [[Rahbar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRahbar()
    {
        return $this->hasOne(User::class, ['id' => 'rahbar_id']);
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['register_id' => 'id']);
    }

    /**
     * Gets query for [[TaskEmps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskEmps()
    {
        return $this->hasMany(TaskEmp::class, ['register_id' => 'id']);
    }
}
