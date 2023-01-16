<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal_boshqa_tashkilot_group".
 *
 * @property int $id
 * @property string $name
 *
 * @property AppealBoshqaTashkilot[] $appealBoshqaTashkilots
 */
class AppealBoshqaTashkilotGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_boshqa_tashkilot_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Номи',
        ];
    }

    /**
     * Gets query for [[AppealBoshqaTashkilots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTashkilotlar()
    {
        return $this->hasMany(AppealBoshqaTashkilot::class, ['group_id' => 'id']);
    }

}
