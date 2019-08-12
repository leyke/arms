<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\models\Application;
use app\models\Rule;
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
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'ARM System',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            [
                'label' => Application::LABEL,
                'url' => ['/application/index'],
            ],
            [
                'label' => Rule::LABEL,
                'url' => ['/rule/index'],
                'items' => [
                    ['label' => 'Правила', 'url' => ['/rule/index']],
                    ['label' => \app\models\Event::LABEL, 'url' => ['/event/index']],
                    ['label' => \app\models\Action::LABEL, 'url' => ['/action/index']],
                ]
            ],
            [
                'label' => 'Администрирование',
                'items' => [
                    ['label' => 'Пользователи', 'url' => ['/user/index']],
                    ['label' => 'Роли', 'url' => ['/role/index']],
                ]
            ],
            ['label' => 'Документация', 'url' => ['/documentation/index']],


            Yii::$app->user->isGuest ? (
            ['label' => 'Логин', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->name . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => ['label' => 'Главная', 'url' => ['/']]
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; МОиПЭВМ ПГУ <?= date('Y') ?></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
