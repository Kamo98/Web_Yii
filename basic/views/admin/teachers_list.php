<?php

use yii\bootstrap4\Html;

$i = 0;
/** @var $teacherProfiles */

foreach ($teacherProfiles as $profile) :
    if ($i % 2 == 0)
        echo "<div class=\"row\">";
    ?>

    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <?= $profile->teacher['FIO'] ?>
                    <small class="text-muted nameDiscipline"><?= $profile->discipline['Name'] ?></small>
                </h4>
                <a data-fancybox="gallery" href= <?="/img/". $profile->teacher['Avatar']?> >
                    <img class = "img-left" src= <?="/img/". $profile->teacher['Avatar_mini']?>>
                </a>
                <p class="card-text"> <?= $profile->teacher['education']?> </p>
                <p class="card-text"><?= $profile->teacher['experience']?></p>
                <?= Html::a('Подробнее...', ['/site/teacher', 'id' => $profile['id_profile']], ['class' => 'btn btn-primary']); ?>
                <p class="textPrice text-right"> <?= $profile['price'] ?> руб/ч</p>

                <div class = "adminPanel">
                    <div class="row">
                        <div class="col-md">
                            <?= Html::a('Удалить', [''],
                                ['class' => 'btn btn-outline-warning btn_del', 'id' => $profile['id_profile']]); ?>
                            <!--                                <a href="" class="btn btn-outline-warning" id="delTeach_1">Удалить</a>-->
                        </div>
                        <div class="col-md">
                            <?= Html::a('Изменить', ['/admin/edit', 'id' => $profile['id_teacher']],
                                ['class' => 'btn btn-outline-primary', 'id' => 'changeTeach_1']); ?>
                            <!--                                <a href="" class="btn btn-outline-primary" id="changeTeach_1" >Изменить</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    if ($i % 2 == 1)
        echo "</div>";
    $i++;
endforeach; ?>