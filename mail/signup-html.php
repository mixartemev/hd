<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $user app\models\User */
?>
<div class="signup-request">
    <p><?= Yii::t('app', 'Hello {username}', ['username' => $user->username]); ?>,</p>
    <p>Вы зарегистрировались на <?= Yii::$app->name ?>
       И мы одобрили Вашу заявку, можете <?=Html::a('входить', Yii::$app->urlManager->createAbsoluteUrl('/') )?> под логином: <?= $user->username ?> и паролем, с которым регистрировались.
    </p>
</div>
