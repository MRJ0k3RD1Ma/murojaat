<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_fullstat".
 *
 * @property int $comp_id
 * @property int|null $count_not_quest
 * @property int|null $count_not_quest_quyi
 */
class ViewFullstat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_fullstat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comp_id', 'count_not_quest', 'count_not_quest_quyi'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comp_id' => 'Comp ID',
            'count_not_quest' => 'Count Not Quest',
            'count_not_quest_quyi' => 'Count Not Quest Quyi',
        ];
    }
}
