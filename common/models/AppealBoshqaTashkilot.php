<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal_boshqa_tashkilot".
 *
 * @property int $id
 * @property string $name
 * @property int $group_id
 * @property int $isdelete
 *
 * @property Appeal[] $appeals
 * @property AppealBoshqaTashkilotGroup $group
 */
class AppealBoshqaTashkilot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_boshqa_tashkilot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'group_id'], 'required'],
            [['group_id', 'isdelete'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppealBoshqaTashkilotGroup::class, 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ташкилот номи',
            'group_id' => 'Ташкилот гуруҳи',
            'isdelete' => 'Isdelete',
        ];
    }

    /**
     * Gets query for [[Appeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeals()
    {
        return $this->hasMany(Appeal::class, ['boshqa_tashkilot_id' => 'id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(AppealBoshqaTashkilotGroup::class, ['id' => 'group_id']);
    }
}
