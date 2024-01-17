<?php

use app\models\Professions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\helpers\AppHelper;

/** @var yii\web\View $this */
/** @var app\models\ProfessionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Специализации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professions-index">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?php if (AppHelper::isMainDoctor()): ?>
            <?= Html::a('Добавить специализацию', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            [
                'class' => ActionColumn::className(),
                'visibleButtons' => [
                    'update' => function ($model, $key, $index) {
                            return AppHelper::isMainDoctor();
                        },
                    'delete' => function ($model, $key, $index) {
                            return AppHelper::isMainDoctor();
                        },
                ],
                'urlCreator' => function ($action, Professions $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>