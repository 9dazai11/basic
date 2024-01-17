<?php

use app\models\MedicalRecords;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\MedicalRecordsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Медкарты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-records-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать медкарту', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'client_id',
                    MedicalRecords::getDropDownList(),
                ['class'=>'form-control','prompt'=>'Выберите пациента']),],
            'record_date',
            'notes:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MedicalRecords $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
