<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

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
    public $region_id,$district_id;
    public $letter,$task_txt;
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
            [['region_id','district_id','pursuit', 'person_id', 'gender', 'soato_id', 'isbusinessman', 'question_id', 'appeal_type_id', 'appeal_shakl_id', 'appeal_control_id', 'count_applicant', 'count_list', 'status', 'boshqa_tashkilot', 'boshqa_tashkilot_id', 'answer_reply_send', 'company_id', 'register_id', 'register_company_id', 'type', 'number', 'year', 'employment_id'], 'integer'],
            [['person_name', 'person_phone','gender',  'address', 'appeal_detail', 'appeal_type_id', 'register_id', 'register_company_id'], 'required'],
            [['date_of_birth', 'deadtime', 'created', 'updated', 'boshqa_tashkilot_date', 'answer_date'], 'safe'],
            [['person_name', 'person_phone','gender',  'address', 'appeal_detail',],'required','on'=>'v_district'],
            [['appeal_preview', 'appeal_detail', 'executor_files', 'answer_detail'], 'string'],
            [['address','gender', 'appeal_detail', 'appeal_type_id',], 'required','on'=>'insert'],
            [['answer_name','answer_preview','answer_number','appeal_control_id','answer_date',],'required','on'=>'close'],
            [['passport', 'passport_jshshir', 'person_name', 'person_phone', 'address', 'email', 'appeal_file', 'appeal_file_extension', 'boshqa_tashkilot_number', 'answer_name', 'answer_file', 'answer_preview', 'answer_number', 'number_full'], 'string', 'max' => 255],
            [['businessman','task_txt'], 'string', 'max' => 500],
            [['appeal_shakl_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealShakl::class, 'targetAttribute' => ['appeal_shakl_id' => 'id']],
            [['appeal_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealType::class, 'targetAttribute' => ['appeal_type_id' => 'id']],
            [['boshqa_tashkilot_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealBoshqaTashkilot::class, 'targetAttribute' => ['boshqa_tashkilot_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
            [['employment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employment::class, 'targetAttribute' => ['employment_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealQuestion::class, 'targetAttribute' => ['question_id' => 'id']],
            [['register_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['register_company_id' => 'id']],
            [['register_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['register_id' => 'id']],
            [['soato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::class, 'targetAttribute' => ['soato_id' => 'id']],
            ['letter','file'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pursuit' => 'Тақиб ҳақида огоҳлантириш',
            'passport' => 'Паспорт серия рақами',
            'passport_jshshir' => 'ЖШ ШИР(ПНФЛ)',
            'person_id' => 'Person ID',
            'person_name' => 'ФИО',
            'letter'=>'Кузатувчи хат',
            'person_phone' => 'Телефон',
            'date_of_birth' => 'Туғилган санаси',
            'gender' => 'Жинси',
            'soato_id' => 'Маҳалла',
            'task_txt' => 'Топшириқ матни',
            'address' => 'Манзил',
            'email' => 'Эл-Почта',
            'businessman' => 'Тадбиркорлик субьекти',
            'isbusinessman' => 'Юридик шахс',
            'appeal_preview' => 'Appeal Preview',
            'appeal_detail' => 'Мурожаат матни',
            'appeal_file' => 'Файл',
            'question_id' => 'Масаласи',
            'executor_files' => 'Executor Files',
            'appeal_file_extension' => 'Appeal File Extension',
            'appeal_type_id' => 'Мурожаат тури',
            'appeal_shakl_id' => 'Мурожаат шакли',
            'appeal_control_id' => 'Ҳолати',
            'count_applicant' => 'Мурожаатчилар',
            'count_list' => 'Варақлар сони',
            'status' => 'Статус',
            'deadtime' => 'Муддат',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирлди',
            'boshqa_tashkilot' => 'Бошқа ташкилот',
            'boshqa_tashkilot_number' => 'Рақами',
            'boshqa_tashkilot_date' => 'Санаси',
            'boshqa_tashkilot_id' => 'Ташкилот',
            'answer_name' => 'Ҳужжат номи',
            'answer_file' => 'Файл',
            'answer_preview' => 'Ҳужжат номи',
            'answer_detail' => 'Мазмуни',
            'answer_reply_send' => 'Жавоб мурожаатчига юборилди',
            'answer_number' => 'Рақами',
            'answer_date' => 'Санаси',
            'company_id' => 'Ташкилот',
            'register_id' => 'Register ID',
            'register_company_id' => 'Рўйхатга олувчи ташкилот',
            'type' => 'Type',
            'number' => 'Number',
            'year' => 'Year',
            'number_full' => 'Рақами',
            'employment_id' => 'Ижтимоий статус',
            'region_id' => 'Вилоят',
            'district_id' => 'Туман',
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
    public function upload(){
        if($this->letter = UploadedFile::getInstance($this,'letter')){
            $name = microtime(true).'.'.$this->letter->extension;
            $this->letter->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
            $this->letter = $name;
        }
    }
    public function uploadAppeal(){
        if($this->appeal_file = UploadedFile::getInstance($this,'appeal_file')){
            $name = microtime(true).'.'.$this->appeal_file->extension;
            $this->appeal_file->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
            $this->appeal_file = $name;
        }
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


    public function getRegion(){
        $soato = $this->soato;
        return Soato::findOne($soato->res_id.$soato->region_id)->name_cyr;
    }
    public function getDistrict(){
        $soato = $this->soato;
        return Soato::findOne($soato->res_id.$soato->region_id.$soato->district_id)->name_cyr;
    }
    public function getVillage(){
        return $this->hasOne(Soato::class, ['id' => 'soato_id']);
    }
}
