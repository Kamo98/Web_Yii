<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.02.2020
 * Time: 10:11
 */

namespace app\models;


use yii\base\Model;

class FilterTeachers extends Model
{
    public $discipline;
    public $price;

    public function rules()
    {
        return [[['discipline', 'price'], 'required']];
    }

    public function attributeLabels()
    {
        return [
            'discipline' => 'Дисциплина',
            'price' => 'Цена за час'
        ];
    }

}