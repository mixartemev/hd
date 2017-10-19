<?php

/* @var $this yii\web\View */
/* @var app\models\form\ExcelForm $excelForm */

use yii\widgets\ActiveForm;

//$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1></h1>

        <p class="lead"></p>

    </div>

    <div class="body-content">
        <?php
        /** @var array $data */
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
        echo $form->field($excelForm, 'file')->fileInput();
        echo \yii\helpers\Html::submitButton('Загрузить');
        ActiveForm::end();
        ?>
    </div>
</div>
