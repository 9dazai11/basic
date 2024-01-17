<?php

use app\models\Doctors;
use app\models\Reception;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Clients;
use Yii;

/** @var yii\web\View $this */
/** @var app\models\ReceptionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Приемы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reception-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить прием', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    function getClientsMap() {
        if (Yii::$app->user->identity->is_doctor) {
            return ArrayHelper::map(Clients::find()
            ->all(), 'id', 'FIO');        
        } else {
            return ArrayHelper::map(Clients::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->all(), 'id', 'FIO');
        }
    }

    function getDoctorsMap() {
        return ArrayHelper::map(Doctors::find()
            ->all(), 'id', 'FIO');
    }
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'client_id',
            ['attribute' => 'client_id',
                'label' => 'Пациент',
                'value' => function ($model) {
                        return $model->client->FIO;
                    },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'client_id',
                    getClientsMap(),
                    ['class'=>'form-control','prompt'=>'Выберите пациента']
                )],
            //'doctor_id',
            ['attribute' => 'doctor_id',
                'label' => 'Врач',
                'value' => function ($model) {
                        return $model->doctor->FIO;
                    },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'doctor_id',
                    getDoctorsMap(),
                    ['class'=>'form-control','prompt'=>'Выберите врача']
                )],
            'admission_date',
            'status',
            [
                'class' => ActionColumn::className(),
                // 'visibleButtons' => [
                //     'update' => function ($model, $key, $index) {
                //     return AppHelper::isVisibleForAdmin();
                // },
                //     'delete' => function ($model, $key, $index) {
                //     return AppHelper::isVisibleForAdmin();
                // },
                // ],
                'urlCreator' => function ($action, Reception $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
