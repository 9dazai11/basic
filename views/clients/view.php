<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\AppHelper;

/** @var yii\web\View $this */
/** @var app\models\Clients $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пациенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clients-view">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

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
            //'user_id',
            'FIO',
            'date_of_birth',
            'sex',
            'serial_passport',
            'number_passport',
            'phone',
            'address',
            'medical_policy',
            'insurance_policy',
        ],
    ]) ?>

    <?php if (AppHelper::isDoctor()): ?>

        <h2>Медицинские записи:</h2>
        <?= GridView::widget([
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $model->getMedicalRecords(),
            ]),
            'columns' => [
                ['attribute' => 'client_id',
                'label' => 'Пациент',
                'value' => function ($model) {
                        return $model->client->FIO;
                    },],
                'record_date',
                'notes:ntext',
            ],
        ])
            ?>
    <?php endif; ?>
</div>