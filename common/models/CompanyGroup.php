<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_group".
 *
 * @property int $id
 * @property string $name
 *
 * @property Company[] $companies
 * @property CompanyType[] $companyTypes
 */
class CompanyGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_group';
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
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['group_id' => 'id']);
    }

    /**
     * Gets query for [[CompanyTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyTypes()
    {
        return $this->hasMany(CompanyType::className(), ['group_id' => 'id']);
    }
}
