<?php

/** @var yii\web\View $this */
/** @var app\models\User $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Здравствуйте <?= $user->username ?>,

Для подтверждения почты, перейдите по ссылке:

<?= $verifyLink ?>
