<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'is_doctor')->dropDownList(
        ArrayHelper::map(
            [
                ['id' => 0, 'name' => 'Нет'],
                ['id' => 1, 'name' => 'Да']
            ],
            'id',
            'name'
        ),
        ['prompt' => 'Выберите является ли врачом']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
