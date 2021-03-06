<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Курсовая работа',
        'brandImage' => '/img/logo.jpg',
        'options' => [
            'class' => 'navbar',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/admin']],
            ['label' => 'Организаторы', 'url' => ['/admin/organizer']],
            ['label' => 'Распложение',
                'options'=>['class'=>'dropdown'],
                'template' => '<a href="#">{label}</a>',
                'items' => [
                    ['label' => 'Отделение', 'url' => ['/admin/location']],
                    ['label' => 'Кабинеты', 'url' => ['/admin/cabinet']],
                ]
            ],
//            ['label' => 'Поставщики', 'url' => ['/admin/provider']],
            ['label' => 'Оборудование',
              'options'=>['class'=>'dropdown'],
              'template' => '<a href="#">{label}</a>',
              'items' => [
                  ['label' => 'Каталог оборудования', 'url' => ['/admin/catalog-oborudovania']],
                  ['label' => 'Оборудование в наличии', 'url' => ['/admin/oborudovanie']],
                  ['label' => 'Списанное оборудование', 'url' => ['/admin/oborudovanie', 'OborudovanieSearch[status]'=>'off']],
              ]
            ],
            ['label' => 'Заявки',
                'options'=>['class'=>'dropdown'],
                'template' => '<a href="#">{label}</a>',
                'items' => [
                    ['label' => 'Заказы', 'url' => ['/admin/orders']],
                    ['label' => 'Заявки на списание', 'url' => ['/admin/write-off']],
                ]
            ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
