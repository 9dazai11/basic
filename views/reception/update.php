<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Reception $model */

$this->title = 'Изменить прием: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Приемы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="reception-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'clientList' => $clientList,
    ]) ?>

</div>
