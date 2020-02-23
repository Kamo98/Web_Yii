<?php

/* @var $this yii\web\View */
/** @var  $teacherProfiles */
/** @var $filterTeachersModel */
/** @var $disciplines */

$this->title = 'Be smart | станьте умнее вместе с нами';

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
use yii\helpers\ArrayHelper;
 ?>
<div class="container" id="catalog_teachers">

    <?php
    $filterTeachersForm = ActiveForm::begin();
    $items = ArrayHelper::map($disciplines,'id_discipline','Name');
    ?>
    <div class="row">
        <div class="col-md">
            <?= $filterTeachersForm->field($filterTeachersModel, 'discipline')->dropDownList($items, ['prompt' => '', ]) ?>
        </div>
        <div class="col-md">
            <?= $filterTeachersForm->field($filterTeachersModel, 'price')->dropDownList([
                    '300-600' => 'От 300 до 600 руб',
                    '600-1000' => 'От 600 до 1000 руб',
                    '1000-1500' => 'От 1000 до 1500 руб',
                    '1500-3000' => 'От 1500 до 3000 руб',
            ], ['prompt' => '', ]) ?>
        </div>
        <div class="col-md">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'id'=>'btnSearchTeach']) ?>
            <a href="/basic/web/index.php" class="btn btn-primary">Очистить фильтр</a>
        </div>
    </div>

    <?php ActiveForm::end() ?>


    <div class="row">
        <?php
//        print_array($teacherProfiles[0]->discipline);
        ////        print_array($teacherProfiles[0]->teacher);
        //print_array($teacherProfiles);
        ?>
    </div>

    <?php
    $i = 0;
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
                    <a data-fancybox="gallery" href= <?="/basic/web/img/". $profile->teacher['Avatar']?> >
                        <img class = "img-left" src= <?="/basic/web/img/". $profile->teacher['Avatar_mini']?>>
                    </a>
                    <p class="card-text"> <?= $profile->teacher['education']?> </p>
                    <p class="card-text"><?= $profile->teacher['experience']?></p>
                    <a href="teacher.html" class="btn btn-primary">Подробнее...</a>
                    <p class="textPrice text-right"> <?= $profile['price'] ?> руб/ч</p>

                </div>
            </div>
        </div>

    <?php
        if ($i % 2 == 1)
            echo "</div>";
        $i++;
    endforeach; ?>


</div>