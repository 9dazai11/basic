<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Professions $model */

$this->title = 'Добавить специализацию';
$this->params['breadcrumbs'][] = ['label' => 'Специализации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
