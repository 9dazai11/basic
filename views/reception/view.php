<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Reception $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Приемы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reception-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'client_id',
                'label' => 'Пациент',
                'value' => function ($model) {
                        return $model->client->FIO;
                    },
            ],
            [
                'attribute' => 'doctor_id',
                'label' => 'Врач',
                'value' => function ($model) {
                        return $model->doctor->FIO;
                    },
            ],
            'admission_date',
            'status',
        ],
    ]) ?>

</div>
