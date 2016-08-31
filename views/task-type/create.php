<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaskType */

$this->title = Yii::t('app', 'Create Task Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Task Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
