<?php

use app\models\Clients;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\MedicalRecords $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="medical-records-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList(
        ArrayHelper::map(Clients::find()->all(),'id','FIO'),
        ['prompt' => 'Выберите пациента']
    ) ?>

    <?= $form->field($model, 'record_date')->input("datetime-local", ['min' => date('Y-m-d\TH:i')]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
