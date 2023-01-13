<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_old".
 *
 * @property int $id
 * @property int $role_id
 * @property int $company_id
 * @property string $name
 * @property string $image
 * @property string $username
 * @property string $password
 * @property string|null $phone
 * @property string|null $address
 * @property int $bulim_id
 * @property int $lavozim_id
 * @property int $is_rahbar
 * @property int $is_registration
 * @property int $is_resolution
 * @property int $is_control
 * @property int $is_control_system
 * @property int $is_control_district
 * @property string $created
 * @property string $updated
 * @property int $status
 * @property int $active
 * @property int $is_village
 */
class UserOld extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_old';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'company_id', 'name', 'username', 'password', 'bulim_id', 'lavozim_id'], 'required'],
            [['role_id', 'company_id', 'bulim_id', 'lavozim_id', 'is_rahbar', 'is_registration', 'is_resolution', 'is_control', 'is_control_system', 'is_control_district', 'status', 'active', 'is_village'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'image', 'username', 'address'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 500],
            [['phone'], 'string', 'max' => 20],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'image' => 'Image',
            'username' => 'Username',
            'password' => 'Password',
            'phone' => 'Phone',
            'address' => 'Address',
            'bulim_id' => 'Bulim ID',
            'lavozim_id' => 'Lavozim ID',
            'is_rahbar' => 'Is Rahbar',
            'is_registration' => 'Is Registration',
            'is_resolution' => 'Is Resolution',
            'is_control' => 'Is Control',
            'is_control_system' => 'Is Control System',
            'is_control_district' => 'Is Control District',
            'created' => 'Created',
            'updated' => 'Updated',
            'status' => 'Status',
            'active' => 'Active',
            'is_village' => 'Is Village',
        ];
    }
}
