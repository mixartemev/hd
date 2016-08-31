<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\form\PasswordChangeForm */
/* @var int $uId */

$this->title = 'Смена пароля';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile'), 'url' => ['profile','id' => $uId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-row lk-wrapper">
	<div class="lk-form">
		<?php $form = ActiveForm::begin([
			'fieldConfig' => [
				'inputOptions' => ['class' => 'base-input'],
			],
		]); ?>

		<div class="wrap-group"><?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?></div>
		<div class="wrap-group"><?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?></div>
		<div class="wrap-group"><?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?></div>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary change-lk', 'name' => 'change-button']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>

</div>