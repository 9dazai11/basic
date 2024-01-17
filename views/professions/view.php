<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\AppHelper;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Professions $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Специализации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="professions-view">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?php if (AppHelper::isMainDoctor()): ?>
            <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
        ],
    ]) ?>

    <?php if (!AppHelper::isDoctor()): ?>

        <h2>Врачи:</h2>
        <?= GridView::widget([
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $model->getDoctors(),
            ]),
            'columns' => [
                'FIO',
                [
                    'attribute' => 'profession_id',
                    'label' => 'Специализация',
                    'value' => function ($model) {
                            return $model->profession->name;
                        },
                ],
            ],
        ]) ?>
    <?php endif; ?>
</div>