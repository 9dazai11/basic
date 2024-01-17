<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\helpers\AppHelper;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md fixed-top',
                'style' => 'background-color: #008BFF'
            ],

        ]);
        $menuItems = [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О нас', 'url' => ['/site/about']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
            // ['label' => 'Услуги', 'url' => ['/site/services']],
        ];
        
        if (AppHelper::isMainDoctor()) {
            $menuItems[] = ['label' => 'Пользователи', 'url' => ['/user']];
            $menuItems[] = ['label' => 'Врачи', 'url' => ['/doctors']];
            $menuItems[] = ['label' => 'Специализации', 'url' => ['/professions']];
        }
        
        if (AppHelper::isDoctor())
        {
            $menuItems[] = ['label' => 'Пациенты', 'url' => ['/clients']];
            $menuItems[] = ['label' => 'Приемы', 'url' => ['/reception']];
            $menuItems[] = ['label' => 'Медкарты', 'url' => ['/medical-records']];
        }

        if (AppHelper::isPatient()) {
            $menuItems[] = ['label' => 'Профиль', 'url' => ['/clients']];
            $menuItems[] = ['label' => 'Приемы', 'url' => ['/reception']];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);
        if (Yii::$app->user->isGuest) {
            echo Html::tag('div', Html::a('Войти', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none'], 'style' => 'color: black;']), ['class' => ['d-flex']]);
        } else {
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    [
                        'class' => 'btn btn-link logout text-decoration-none',
                        'style' => 'color:black',
                        'data' => [
                            'confirm' => 'Уверены, что хотите выйти из аккаунта?',
                        ],
                    ]
                )
                . Html::endForm();
        }
        if (Yii::$app->user->isGuest) {
            echo Html::tag('div', Html::a('Регистрация', ['/site/signup'], 
            ['class'=>['btn btn-link signup text-decoration-none'], 'style'=>'color:black;']), ['class'=>['navbar-right']]);
        NavBar::end();
        }
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget([
                    'links' => $this->params['breadcrumbs'],
                    'homeLink' => [
                        'label' => 'Главная',
                        'url' => Yii::$app->homeUrl
                    ]
                ]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-3" style="background-color: #008BFF">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start" style="color: white">&copy; Поликлиника "ЗаботаЗдоровья"
                    <?= date('Y') ?>
                </div>
                <!-- <div class="col-md-6 text-center text-md-end">
                    <?= Yii::powered() ?>
                </div> -->
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>