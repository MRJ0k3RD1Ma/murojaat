<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal_send".
 *
 * @property int $id
 * @property int $user_id
 * @property int $appeal_id
 * @property int $company_id
 * @property int|null $status_id
 * @property string|null $updated
 * @property string|null $deadline
 * @property string|null $created
 *
 * @property Appeal $appeal
 * @property Company $company
 * @property AppealStatus $status
 * @property User $user
 */
class AppealSend extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_send';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'appeal_id', 'company_id'], 'required'],
            [['user_id', 'appeal_id', 'company_id', 'status_id'], 'integer'],
            [['updated', 'deadline', 'created'], 'safe'],
            [['appeal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appeal::className(), 'targetAttribute' => ['appeal_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'appeal_id' => 'Appeal ID',
            'company_id' => 'Company ID',
            'status_id' => 'Status ID',
            'updated' => 'Updated',
            'deadline' => 'Deadline',
            'created' => 'Created',
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(AppealStatus::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
