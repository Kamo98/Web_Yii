
<?php

/** @var $teacherProfiles */

use yii\bootstrap4\Html;

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
            </div>
        </div>
    </div>

    <?php
    if ($i % 2 == 1)
        echo "</div>";
    $i++;
endforeach; ?>