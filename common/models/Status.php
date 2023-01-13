<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 *
 * @property AppealBajaruvchi[] $appealBajaruvchis
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
            [['icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'icon' => 'Icon',
        ];
    }

    /**
     * Gets query for [[AppealBajaruvchis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealBajaruvchis()
    {
        return $this->hasMany(AppealBajaruvchi::class, ['status' => 'id']);
    }
}
