<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal".
 *
 * @property int $id
 * @property int $pursuit
 * @property string|null $passport
 * @property string|null $passport_jshshir
 * @property int|null $person_id
 * @property string $person_name
 * @property string $person_phone
 * @property string|null $date_of_birth
 * @property int $gender
 * @property int $soato_id
 * @property string $address
 * @property string|null $email
 * @property string|null $businessman
 * @property int $isbusinessman
 * @property string|null $appeal_preview
 * @property string $appeal_detail
 * @property string|null $appeal_file
 * @property int|null $question_id
 * @property string|null $executor_files
 * @property string|null $appeal_file_extension
 * @property int $appeal_type_id
 * @property int|null $appeal_shakl_id
 * @property int $appeal_control_id
 * @property int $count_applicant
 * @property int $count_list
 * @property int $status
 * @property string|null $deadtime
 * @property string $created
 * @property string $updated
 * @property int $boshqa_tashkilot
 * @property string|null $boshqa_tashkilot_number
 * @property string|null $boshqa_tashkilot_date
 * @property int|null $boshqa_tashkilot_id
 * @property string|null $answer_name
 * @property string|null $answer_file
 * @property string|null $answer_preview
 * @property string|null $answer_detail
 * @property int $answer_reply_send
 * @property string|null $answer_number
 * @property string|null $answer_date
 * @property int|null $company_id
 * @property int $register_id
 * @property int $register_company_id
 * @property int $type
 * @property int $number
 * @property int $year
 * @property string|null $number_full
 * @property int|null $employment_id
 *
 * @property AppealAnswer[] $appealAnswers
 * @property AppealBajaruvchi[] $appealBajaruvchis
 * @property AppealRegister[] $appealRegisters
 * @property AppealShakl $appealShakl
 * @property AppealType $appealType
 * @property AppealBoshqaTashkilot $boshqaTashkilot
 * @property Company $company
 * @property Employment $employment
 * @property AppealQuestion $question
 * @property User $register
 * @property Company $registerCompany
 * @property Request[] $requests
 * @property Soato $soato
 * @property TaskEmp[] $taskEmps
 */
class Appeal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pursuit', 'person_id', 'gender', 'soato_id', 'isbusinessman', 'question_id', 'appeal_type_id', 'appeal_shakl_id', 'appeal_control_id', 'count_applicant', 'count_list', 'status', 'boshqa_tashkilot', 'boshqa_tashkilot_id', 'answer_reply_send', 'company_id', 'register_id', 'register_company_id', 'type', 'number', 'year', 'employment_id'], 'integer'],
            [['person_name', 'person_phone', 'soato_id', 'address', 'appeal_detail', 'appeal_type_id', 'register_id', 'register_company_id'], 'required'],
            [['date_of_birth', 'deadtime', 'created', 'updated', 'boshqa_tashkilot_date', 'answer_date'], 'safe'],
            [['appeal_preview', 'appeal_detail', 'executor_files', 'answer_detail'], 'string'],
            [['passport', 'passport_jshshir', 'person_name', 'person_phone', 'address', 'email', 'appeal_file', 'appeal_file_extension', 'boshqa_tashkilot_number', 'answer_name', 'answer_file', 'answer_preview', 'answer_number', 'number_full'], 'string', 'max' => 255],
            [['businessman'], 'string', 'max' => 500],
            [['appeal_shakl_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealShakl::class, 'targetAttribute' => ['appeal_shakl_id' => 'id']],
            [['appeal_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealType::class, 'targetAttribute' => ['appeal_type_id' => 'id']],
            [['boshqa_tashkilot_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealBoshqaTashkilot::class, 'targetAttribute' => ['boshqa_tashkilot_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
            [['employment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employment::class, 'targetAttribute' => ['employment_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealQuestion::class, 'targetAttribute' => ['question_id' => 'id']],
            [['register_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['register_company_id' => 'id']],
            [['register_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['register_id' => 'id']],
            [['soato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::class, 'targetAttribute' => ['soato_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pursuit' => 'Pursuit',
            'passport' => 'Passport',
            'passport_jshshir' => 'Passport Jshshir',
            'person_id' => 'Person ID',
            'person_name' => 'Person Name',
            'person_phone' => 'Person Phone',
            'date_of_birth' => 'Date Of Birth',
            'gender' => 'Gender',
            'soato_id' => 'Soato ID',
            'address' => 'Address',
            'email' => 'Email',
            'businessman' => 'Businessman',
            'isbusinessman' => 'Isbusinessman',
            'appeal_preview' => 'Appeal Preview',
            'appeal_detail' => 'Appeal Detail',
            'appeal_file' => 'Appeal File',
            'question_id' => 'Question ID',
            'executor_files' => 'Executor Files',
            'appeal_file_extension' => 'Appeal File Extension',
            'appeal_type_id' => 'Appeal Type ID',
            'appeal_shakl_id' => 'Appeal Shakl ID',
            'appeal_control_id' => 'Appeal Control ID',
            'count_applicant' => 'Count Applicant',
            'count_list' => 'Count List',
            'status' => 'Status',
            'deadtime' => 'Deadtime',
            'created' => 'Created',
            'updated' => 'Updated',
            'boshqa_tashkilot' => 'Boshqa Tashkilot',
            'boshqa_tashkilot_number' => 'Boshqa Tashkilot Number',
            'boshqa_tashkilot_date' => 'Boshqa Tashkilot Date',
            'boshqa_tashkilot_id' => 'Boshqa Tashkilot ID',
            'answer_name' => 'Answer Name',
            'answer_file' => 'Answer File',
            'answer_preview' => 'Answer Preview',
            'answer_detail' => 'Answer Detail',
            'answer_reply_send' => 'Answer Reply Send',
            'answer_number' => 'Answer Number',
            'answer_date' => 'Answer Date',
            'company_id' => 'Company ID',
            'register_id' => 'Register ID',
            'register_company_id' => 'Register Company ID',
            'type' => 'Type',
            'number' => 'Number',
            'year' => 'Year',
            'number_full' => 'Number Full',
            'employment_id' => 'Employment ID',
        ];
    }

    /**
     * Gets query for [[AppealAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealAnswers()
    {
        return $this->hasMany(AppealAnswer::class, ['appeal_id' => 'id']);
    }

    /**
     * Gets query for [[AppealBajaruvchis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealBajaruvchis()
    {
        return $this->hasMany(AppealBajaruvchi::class, ['appeal_id' => 'id']);
    }

    /**
     * Gets query for [[AppealRegisters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealRegisters()
    {
        return $this->hasMany(AppealRegister::class, ['appeal_id' => 'id']);
    }

    /**
     * Gets query for [[AppealShakl]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealShakl()
    {
        return $this->hasOne(AppealShakl::class, ['id' => 'appeal_shakl_id']);
    }

    /**
     * Gets query for [[AppealType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealType()
    {
        return $this->hasOne(AppealType::class, ['id' => 'appeal_type_id']);
    }

    /**
     * Gets query for [[BoshqaTashkilot]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoshqaTashkilot()
    {
        return $this->hasOne(AppealBoshqaTashkilot::class, ['id' => 'boshqa_tashkilot_id']);
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
     * Gets query for [[Employment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployment()
    {
        return $this->hasOne(Employment::class, ['id' => 'employment_id']);
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
     * Gets query for [[Register]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegister()
    {
        return $this->hasOne(User::class, ['id' => 'register_id']);
    }

    /**
     * Gets query for [[RegisterCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegisterCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'register_company_id']);
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['appeal_id' => 'id']);
    }

    /**
     * Gets query for [[Soato]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoato()
    {
        return $this->hasOne(Soato::class, ['id' => 'soato_id']);
    }

    /**
     * Gets query for [[TaskEmps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskEmps()
    {
        return $this->hasMany(TaskEmp::class, ['appeal_id' => 'id']);
    }

    public function getStatus0(){
        return $this->hasOne(Status::className(),['id'=>'status']);
    }
}
