<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_village_fives".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $mfy_rais
 * @property string|null $profilaktika_inspektor
 * @property string|null $hokim_yordamchi
 * @property string|null $xotin_qizlar
 * @property string|null $yoshlar_yetakchi
 * @property string|null $deputat
 * @property int|null $sector
 *
 * @property Company $company
 */
class VVillageFives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_village_fives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id','sector'], 'integer'],
            [['company_id'],'unique'],
            [['mfy_rais', 'profilaktika_inspektor', 'hokim_yordamchi', 'xotin_qizlar', 'yoshlar_yetakchi', 'deputat'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'mfy_rais' => 'МФЙ раиси',
            'profilaktika_inspektor' => 'Профилактика инспектори',
            'hokim_yordamchi' => 'Ҳоким ёрдамчиси',
            'xotin_qizlar' => 'Ҳотин қизлар фаоли',
            'yoshlar_yetakchi' => 'Ёшлар етакчиси',
            'deputat' => 'Депутат',
            'sector' => 'Сектор',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }
}
