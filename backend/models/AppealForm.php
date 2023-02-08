<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class AppealForm extends Model
{
    public $name,$birthday,$phone,$address,$email,$type,$yur_name,$body,$file;
    public $gender,$status,$region,$district,$soato_id,$is_yur;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['name','phone','address','email','yur_name','body','file'],'string'],
           [['birthday'],'safe'],
           [['status','gender','region','district','soato_id','type','is_yue'],'integer'],
        ];
    }

}
