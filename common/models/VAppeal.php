<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_appeal".
 *
 * @property int $appeal_id
 * @property int $id
 * @property int $village_id
 * @property int $status_id
 * @property int $company_id
 * @property string|null $task
 * @property string|null $ignore
 * @property string|null $created
 * @property string|null $updated
 *
 * @property Appeal $appeal
 * @property Company $company
 * @property VVillage $village
 */
class VAppeal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_appeal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appeal_id', 'id', 'village_id', 'status_id', 'company_id'], 'required'],
            [['appeal_id', 'id', 'village_id', 'status_id', 'company_id'], 'integer'],
            [['task', 'ignore'], 'string'],
            [['created', 'updated'], 'safe'],
            [['appeal_id', 'id', 'village_id', 'company_id'], 'unique', 'targetAttribute' => ['appeal_id', 'id', 'village_id', 'company_id']],
            [['appeal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appeal::className(), 'targetAttribute' => ['appeal_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => VVillage::className(), 'targetAttribute' => ['village_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appeal_id' => 'Appeal ID',
            'id' => 'ID',
            'village_id' => 'Village ID',
            'status_id' => 'Status ID',
            'company_id' => 'Company ID',
            'task' => 'Task',
            'ignore' => 'Ignore',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * Gets query for [[Appeal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeal()
    {
        return $this->hasOne(Appeal::className(), ['id' => 'appeal_id']);
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * Gets query for [[Village]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVillage()
    {
        return $this->hasOne(VVillage::className(), ['id' => 'village_id']);
    }

    public function getStatus(){
        return $this->hasOne(Status::class,['id'=>'status_id']);
    }
}
