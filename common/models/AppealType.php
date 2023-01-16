<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appeal_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Appeal[] $appeals
 */
class AppealType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_type';
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
     * Gets query for [[Appeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppeals()
    {
        return $this->hasMany(Appeal::class, ['appeal_type_id' => 'id']);
    }
}
