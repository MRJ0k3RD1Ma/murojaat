<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "token".
 *
 * @property int $id
 * @property string $name
 * @property string|null $token
 * @property int|null $status
 * @property string $domain
 * @property int|null $type_id
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $company_id
 *
 * @property TokenType $type
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'type_id', 'company_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'token', 'domain'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TokenType::class, 'targetAttribute' => ['type_id' => 'id']],
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
            'token' => 'Token',
            'status' => 'Status',
            'domain' => 'Domain',
            'type_id' => 'Type ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TokenType::class, ['id' => 'type_id']);
    }
}
