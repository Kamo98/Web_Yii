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
    $filterTeachersForm = ActiveForm::begin(['id' => 'formFilter']);
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
                    '1500-3000' => 'От 1500 до 3000 руб',
            ], ['prompt' => '', ]) ?>
        </div>
        <div class="col-md">
            <?= Html::submitButton('Найти', ['class' => 'btn btn-primary btnSearchTeach', 'id' => 'filterSubmit']) ?>
            <a href="/" class="btn btn-primary btnSearchTeach">Очистить фильтр</a>
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

    <div id = "resFilter">

    </div>


</div>


<?php
$ajaxJS = <<<JS
     //Перехват обработки нажатия кнопки "Найти"
    $('#formFilter').on('beforeSubmit', function() {
        const data = $('#formFilter').serialize();
        alert(data);
        $.ajax({
            url: '/',
            type: 'POST',
            data: data,
            dataType: "html",
            success: function(res) {
                const response = $('#resFilter');
                response.html(res);
                //alert('Success ajax');
            },
            error: function(jqXHR, errMsg){
                alert('Произошла ошибка попробуйте ещё раз');
            }
        });
        return false;
    });
JS;

//Зарегистрируем js-скрипт
$this->registerJs($ajaxJS);

?>