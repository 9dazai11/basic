<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MedicalRecords $model */

$this->title = 'Создать медкарту';
$this->params['breadcrumbs'][] = ['label' => 'Медкарты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-records-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
