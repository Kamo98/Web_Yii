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
                '300-3000' => 'Не важно',
                '300-600' => 'От 300 до 600 руб',
                '600-1000' => 'От 600 до 1000 руб',
                '1000-1500' => 'От 1000 до 1500 руб',
                '1500-3000' => 'От 15000 до 3000 руб',
            ], ['prompt' => '', ]) ?>
        </div>
        <div class="col-md">
            <?= Html::submitButton('Найти', ['class' => 'btn btn-primary btnSearchTeach']) ?>
            <a href="/admin/main" class="btn btn-primary btnSearchTeach">Очистить фильтр</a>
            <a href="/admin/edit" class="btn btn-outline-success" id="addTeach">Добавить преподавателя</a>
        </div>
    </div>

    <?php ActiveForm::end() ?>


    <div class="row" id = "info">
        <?php if(Yii::$app->session->hasFlash('PostDeletedError')): ?>
            <div class="alert alert-error">
                Произошла ошибка при удалении карточки преподавателя, попробуйте ещё раз
            </div>
        <?php endif; ?>

        <?php if(Yii::$app->session->hasFlash('PostDeleted')): ?>
            <div class="alert alert-success">
                Анкета преподавателя успешно удалена
            </div>
        <?php endif; ?>
    </div>

    <div id = "resFilter">
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

    </div>


</div>


<?php
$ajaxJS = <<<JS
     //Перехват обработки нажатия кнопки "Удалить"
    $('.btn_del').on('click', function(e) {
        e.preventDefault();
        data = {'id': $(this).attr('id')};
        //alert(data);
        $.ajax({
            url: '/admin/delete',
            type: 'POST',
            data: data,
            dataType: "html",
            success: function(res) {
                $('#info').html('<div class="alert alert-success">Анкета преподавателя успешно удалена</div>');
                const response = $('#resFilter');
                response.html(res);
                alert('Анкета преподавателя успешно удалена');
            },
            error: function(jqXHR, errMsg){
                alert('Произошла ошибка при удалении, попробуйте ещё раз');
            }
        });
    });
JS;

//Зарегистрируем js-скрипт
$this->registerJs($ajaxJS);

?>