<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18.02.2020
 * Time: 21:14
 */

namespace app\models;


use yii\db\ActiveRecord;

class TeacherProfile extends ActiveRecord
{
    const STATUS_ACTIVE = 1;

    public function table_name() {
        return 'teacher_profile';
    }

    public function getDiscipline(){
        return $this->hasOne(Discipline::class, ['id_discipline' => 'id_discipline']);
    }

    public function getTeacher(){
        return $this->hasOne(Teacher::class, ['id_teacher' => 'id_teacher']);
    }
}