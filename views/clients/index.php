<?php

use app\helpers\AppHelper;
use app\models\Clients;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use Yii;

/** @var yii\web\View $this */
/** @var app\models\ClientsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пациенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?= Html::a('Добавить пациента', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'FIO',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'FIO',
                    ArrayHelper::map(Clients::findAll(['user_id'=>Yii::$app->user->id]), 'id','FIO'),
                    ['class' => 'form-control', 'prompt' => 'Выберите ФИО']
                ),
            ],
            'date_of_birth',
            'sex',
            'serial_passport',
            'number_passport',
            //'phone',
            //'address',
            //'medical_policy',
            //'insurance_policy',
            [
                'class' => ActionColumn::className(),
            
                'urlCreator' => function ($action, Clients $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
            ],
        ],
    ]); ?>

</div>

    <?php Pjax::end(); ?>
