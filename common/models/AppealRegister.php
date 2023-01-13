<?php

namespace common\models;

use Yii;

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
            'number' => 'Number',
            'date' => 'Date',
            'question_id' => 'Question ID',
            'appeal_id' => 'Appeal ID',
            'rahbar_id' => 'Rahbar ID',
            'ijrochi_id' => 'Ijrochi ID',
            'users' => 'Users',
            'user_answer' => 'User Answer',
            'tashkilot' => 'Tashkilot',
            'tashkilot_answer' => 'Tashkilot Answer',
            'parent_bajaruvchi_id' => 'Parent Bajaruvchi ID',
            'deadline' => 'Deadline',
            'deadtime' => 'Deadtime',
            'donetime' => 'Donetime',
            'control_id' => 'Control ID',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'reply_send' => 'Reply Send',
            'preview' => 'Preview',
            'detail' => 'Detail',
            'file' => 'File',
            'company_id' => 'Company ID',
            'answer_send' => 'Answer Send',
            'nazorat' => 'Nazorat',
            'takroriy' => 'Takroriy',
            'takroriy_id' => 'Takroriy ID',
            'takroriy_date' => 'Takroriy Date',
            'takroriy_number' => 'Takroriy Number',
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
