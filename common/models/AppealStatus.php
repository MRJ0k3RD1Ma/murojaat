<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal_status".
 *
 * @property int $id
 * @property string $name
 * @property string|null $color
 *
 * @property AppealSend[] $appealSends
 * @property Appeal[] $appeals
 */
class AppealStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
            [['color'], 'string', 'max' => 255],
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
            'color' => 'Color',
        ];
    }

    /**
     * Gets query for [[AppealSends]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppealSends()
    {
        return $this->hasMany(AppealSend::className(), ['status_id' => 'id']);
    }

    /**
     * Gets query for [[Appeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeals()
    {
        return $this->hasMany(Appeal::className(), ['status_id' => 'id']);
    }
}
