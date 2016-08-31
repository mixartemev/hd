<?php
/* @var $this yii\web\View */
/* @var $user app\models\User */
?>
<?= Yii::t('app', 'Hello {username}', ['username' => $user->username]); ?>,

Вы зарегистрировались на <?= Yii::$app->name ?>

можете входить на сайт под логином: <?= $user->username ?> и паролем, с которым регистрировались,
по ссылке: <?= Yii::$app->urlManager->createAbsoluteUrl('/') ?>