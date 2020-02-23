<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.02.2020
 * Time: 9:23
 */

namespace app\models;


use yii\db\ActiveRecord;

class Teacher extends ActiveRecord
{

    public function getTeacherProfiles(){
        return $this->hasMany(TeacherProfile::class, ['id_teacher' => 'id_teacher']);
    }
}