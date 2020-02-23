<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.02.2020
 * Time: 8:50
 */

namespace app\models;


use yii\db\ActiveRecord;

class Discipline extends ActiveRecord
{

    public function getTeacherProfiles(){
        return $this->hasMany(TeacherProfile::class, ['id_discipline' => 'id_discipline']);
    }
}