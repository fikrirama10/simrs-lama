<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PasienonlineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasienonline-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

  
    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'noregistrasi') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'idpoli') ?>

    <?php // echo $form->field($model, 'nohp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
