<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_home_status".
 *
 * @property int $id
 * @property string $name
 * @property string|null $ads
 *
 * @property VVillage[] $vVillages
 */
class VHomeStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_home_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ads'], 'string'],
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
            'ads' => 'Ads',
        ];
    }

    /**
     * Gets query for [[VVillages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVVillages()
    {
        return $this->hasMany(VVillage::class, ['home_status_id' => 'id']);
    }
}
