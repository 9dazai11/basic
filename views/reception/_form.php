<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Doctors;
/** @var yii\web\View $this */
/** @var app\models\Reception $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reception-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList($clientList, ['prompt' => 'Выберите клиента']) ?>

    <?= $form->field($model, 'doctor_id')->dropDownList(Doctors::getDoctorList(), ['prompt' => 'Выберите врача']) ?>
    <?php
    // UPD: устаналвиваем наш часовой пояс, а то на локалке время минус 3 часа от нашего
    date_default_timezone_set('Europe/Moscow');

    // UPD: используем стороннее расширение Kartik/DateTimePicker
    echo $form->field($model, 'admission_date')->widget(DateTimePicker::classname(), [
        'bsVersion' => '5.x',
        'type' => DateTimePicker::TYPE_INPUT,
        'readonly' => 'true', // запрет ввода даты и времени вручную
        'value' => $model->admission_date, // значение из модели (если открыли форму для редактирования)
        'pluginOptions' => [
            'autoclose'=> true,
            'startDate' => date('Y-m-d H:i'),
            'hoursDisabled' => '0,1,2,3,4,5,6,18,19,20,21,22,23', // Отключение часов за пределами 7-18
            'minuteStep' => 30, // Шаг выбора времени в 30 минут
            'daysOfWeekDisabled' => [0, 6], // Запрет выбора воскресенья и субботы
        ]
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList([ 'создан' => 'Создан', 'завершен' => 'Завершен', 'отменен' => 'Отменен', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
