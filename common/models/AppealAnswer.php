<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal_answer".
 *
 * @property int $id
 * @property int $appeal_id
 * @property int $register_id
 * @property int|null $parent_id
 * @property string|null $preview
 * @property string $detail
 * @property string|null $number
 * @property string|null $date
 * @property string|null $tarqatma_number
 * @property string|null $tarqatma_date
 * @property int $bajaruvchi_id
 * @property int|null $reaply_send
 * @property string|null $name
 * @property string|null $file
 * @property int $status
 * @property int $status_boshqa
 * @property string $created
 * @property string $updated
 *
 * @property Appeal $appeal
 * @property User $bajaruvchi
 * @property AppealBajaruvchi $parent
 * @property AppealRegister $register
 */
class AppealAnswer extends \yii\db\ActiveRecord
{
    public $n_olish;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appeal_id', 'register_id', 'detail', 'bajaruvchi_id'], 'required'],
            [['appeal_id', 'register_id', 'parent_id', 'bajaruvchi_id', 'reaply_send', 'status', 'status_boshqa','n_olish'], 'integer'],
            [['detail','ignore_ads',], 'string'],
			[[ 'file','detail', 'number','date','n_olish','preview','name'],'required','on'=>'send'],
            [['date', 'tarqatma_date', 'created', 'updated'], 'safe'],
            [['preview', 'number', 'tarqatma_number', 'name', 'file'], 'string', 'max' => 255],
            [['appeal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appeal::class, 'targetAttribute' => ['appeal_id' => 'id']],
            [['bajaruvchi_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['bajaruvchi_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealBajaruvchi::class, 'targetAttribute' => ['parent_id' => 'id']],
            [['register_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealRegister::class, 'targetAttribute' => ['register_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent_id' => 'Юборувчи',
            'status_boshqa' => 'Статус',
            'id' => 'ID',
            'status' => 'Ҳолат',
            'n_olish' => 'Назоратдан олиш',
            'appeal_id' => 'Ҳужжат рақами',
            'register_id' => 'регистрация',
            'preview' => 'Ҳужжат номи',
            'detail' => 'Мазмуни',
            'number' => 'Рақами',
            'date' => 'Санаси',
            'tarqatma_number' => 'Тарқатма рақами',
            'tarqatma_date' => 'Тарқатма санаси',
            'bajaruvchi_id' => 'Юборувчи',
            'reaply_send' => 'Жавоб мурожаатчига юборилди',
            'name' => 'Ижрочи',
            'file' => 'Файл',
            'created' => 'Юборилди',
            'updated' => 'Тасдиқланди',
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
     * Gets query for [[Bajaruvchi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBajaruvchi()
    {
        return $this->hasOne(User::class, ['id' => 'bajaruvchi_id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(AppealBajaruvchi::class, ['id' => 'parent_id']);
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
}
