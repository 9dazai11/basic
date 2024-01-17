<?php

use app\models\Doctors;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\DoctorsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Врачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-index">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?= Html::a('Добавить врача', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            'FIO',
            ['attribute' => 'profession_id',
                'label' => 'Специализация',
                'value' => function ($model) {
                        return $model->profession->name;
                    },
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'profession_id',
                    Doctors::getDropDownList(),
                    ['class'=>'form-control','prompt'=>'Выберите специализацию']),],
            'cabinet',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Doctors $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>