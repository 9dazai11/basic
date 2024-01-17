<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Clients $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="clients-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(Yii::$app->user->identity->is_doctor == 0) {
        echo $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
    }?>
    
    <?= $form->field($model, 'FIO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_of_birth')->input("date", ['class' => 'form-control']) ?>

    <?= $form->field($model, 'sex')->dropDownList([ 'мужской' => 'Мужской', 'женский' => 'Женский', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'serial_passport')->textInput() ?>

    <?= $form->field($model, 'number_passport')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'medical_policy')->textInput() ?>

    <?= $form->field($model, 'insurance_policy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
