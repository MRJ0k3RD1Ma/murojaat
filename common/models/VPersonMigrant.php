<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_person_migrant".
 *
 * @property int $id
 * @property int $village_id
 * @property string|null $person_name
 * @property string|null $birthday
 *
 * @property VVillage $village
 */
class VPersonMigrant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_person_migrant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'village_id'], 'required'],
            [['id', 'village_id'], 'integer'],
            [['birthday'], 'safe'],
            [['person_name'], 'string', 'max' => 255],
            [['id', 'village_id'], 'unique', 'targetAttribute' => ['id', 'village_id']],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => VVillage::class, 'targetAttribute' => ['village_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'village_id' => 'Village ID',
            'person_name' => 'Person Name',
            'birthday' => 'Birthday',
        ];
    }

    /**
     * Gets query for [[Village]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVillage()
    {
        return $this->hasOne(VVillage::class, ['id' => 'village_id']);
    }
}
