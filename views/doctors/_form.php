<?php

use app\models\Professions;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Doctors $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="doctors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'FIO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profession_id')->dropDownList(
        ArrayHelper::map(Professions::find()->all(), 'id', 'name'), // 'id' и 'name' замените на фактические названия столбцов
        ['prompt' => 'Выберите специализацию']
    ) ?>

    <?= $form->field($model, 'cabinet')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>