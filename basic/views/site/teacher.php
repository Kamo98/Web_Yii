<?php
/** @var $teacherProfile */
?>

<div class="container" id="infoTeacher">
    <div class="row">
        <div class="col-md">
            <h4>
                <?= $teacherProfile->teacher['FIO'];?>
            </h4>
        </div>
        <div class="col-md">
            <p class="text-muted nameDiscipline">Дисциплина: <?= $teacherProfile->discipline['Name'] ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img class = "img-left" src= <?="/img/". $teacherProfile->teacher['Avatar']?>>
        </div>
        <div class="col-md-8">
            <p> <?= $teacherProfile->teacher['education']?> </p>
            <p><?= $teacherProfile->teacher['experience']?></p>
            <p><?= $teacherProfile->teacher['about_me']?></p>
            <p>Телефон: <?= $teacherProfile->teacher['phone']?></p>
            <p>Почта: <?= $teacherProfile->teacher['email']?></p>
            <p>Цена: <?= $teacherProfile['price']?> руб/ч</p>
        </div>
    </div>
</div>