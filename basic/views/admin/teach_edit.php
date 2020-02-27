<?php

use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var $disciplines */
/** @var $teachEditModel */

//print_array($teachEditModel);

?>


<div class="container" id="infoTeacher">

    <div class="row">
        <?php if(Yii::$app->session->hasFlash('SaveTeachSuccess')): ?>
            <div class="alert alert-success">
                Анкета преподавателя успешно изменена
            </div>
        <?php endif; ?>
        <?php if(Yii::$app->session->hasFlash('AddTeachSuccess')): ?>
            <div class="alert alert-success">
                Новый преподаватель успешно создан
            </div>
        <?php endif; ?>
    </div>

    <?php
    $teachEditForm = ActiveForm::begin();
    $items = ArrayHelper::map($disciplines,'id_discipline','Name');
    ?>

    <div class="row">
        <div class="col-md">
            <?= $teachEditForm->field($teachEditModel, 'FIO')->textInput(); ?>
        </div>
        <div class="col-md">
            <div class="row">
                <div class="col-md">
                    <?= $teachEditForm->field($teachEditModel, 'disciplines[0]')->dropDownList($items, ['prompt' => '', ]) ?>
                    <?= $teachEditForm->field($teachEditModel, 'disciplines[1]')->dropDownList($items, ['prompt' => '', ]) ?>
                    <?= $teachEditForm->field($teachEditModel, 'disciplines[2]')->dropDownList($items, ['prompt' => '', ]) ?>
                </div>
                <div class="col-md">
                    <?= $teachEditForm->field($teachEditModel, 'prices[0]')->textInput(); ?>
                    <?= $teachEditForm->field($teachEditModel, 'prices[1]')->textInput(); ?>
                    <?= $teachEditForm->field($teachEditModel, 'prices[2]')->textInput(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img class = "img-left" src="/img/standart_big.jpg">
<!--            <label>-->
<!--                Изменить аватар-->
<!--                <input type="file" id ="avatar">-->
<!--            </label>-->
        </div>
        <div class="col-md-8">
            <?= $teachEditForm->field($teachEditModel, 'education')->textarea(['rows' => '5']); ?>

            <?= $teachEditForm->field($teachEditModel, 'experience')->textarea(['rows' => '5']); ?>

            <?= $teachEditForm->field($teachEditModel, 'aboutMe')->textarea(['rows' => '5']); ?>

            <?= $teachEditForm->field($teachEditModel, 'phone')->textInput(); ?>

            <?= $teachEditForm->field($teachEditModel, 'email')->input('email'); ?>

        </div>
    </div>
    <div class="row">
       <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
    </div>

    <?php
    ActiveForm::end();
    ?>
</div>