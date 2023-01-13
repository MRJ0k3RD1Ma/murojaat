<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal_shakl".
 *
 * @property int $id
 * @property string $name
 *
 * @property Appeal[] $appeals
 */
class AppealShakl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_shakl';
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
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Appeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeals()
    {
        return $this->hasMany(Appeal::class, ['appeal_shakl_id' => 'id']);
    }
}
