<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Performer */

$this->title = Yii::t('app', 'Create Performer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Performers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="performer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
