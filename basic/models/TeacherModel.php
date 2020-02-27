<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26.02.2020
 * Time: 16:19
 */

namespace app\models;


use yii\base\Model;

class TeacherModel extends Model
{

    public $FIO;
//    public $discipline1;
//    public $discipline2;
//    public $discipline3;
//    public $price1;
//    public $price2;
//    public $price3;
    public $disciplines;
    public $prices;
    public $education;
    public $experience;
    public $aboutMe;
    public $phone;
    public $email;


    public function rules()
    {
        return [
            [['FIO', 'education', 'experience', 'aboutMe', 'email', 'phone'], 'required'],
            [['prices'], 'integer'],
            [['disciplines'], 'string'],
            [['email'], 'email'],
            [['phone'], 'number']
            ];
    }

    public function attributeLabels()
    {
        return [
            'FIO' => 'ФИО',
            'disciplines' => 'Преподаваемая дисциплина',
            'prices' => 'Цена за час',
            'education' => 'Образование',
            'experience' => 'Опыт работы',
            'aboutMe' => 'Обо мне',
            'phone' => 'Номер телефона',
            'email' => 'Адрес электронной почты'
        ];
    }

}