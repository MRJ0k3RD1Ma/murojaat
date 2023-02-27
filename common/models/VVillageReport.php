<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_village_report".
 *
 * @property int $soato_id
 * @property string|null $report_date
 * @property string|null $next_date
 */
class VVillageReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_village_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['soato_id'], 'required'],
            [['soato_id'], 'integer'],
            [['report_date', 'next_date'], 'safe'],
            [['soato_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'soato_id' => 'Soato ID',
            'report_date' => 'Report Date',
            'next_date' => 'Next Date',
        ];
    }
}
