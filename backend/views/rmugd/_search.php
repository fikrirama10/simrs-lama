<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RmugdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rmugd-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'diagnosa') ?>

    <?= $form->field($model, 'df') ?>

    <?php // echo $form->field($model, 'jampermintaan') ?>

    <?php // echo $form->field($model, 'jamdatang') ?>

    <?php // echo $form->field($model, 'sesuai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
