<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AsesmenpasienSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asesmenpasien-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'anamesisi') ?>

    <?= $form->field($model, 'ass_psiko') ?>

    <?= $form->field($model, 'rx_fisik') ?>

    <?php // echo $form->field($model, 'penunjang') ?>

    <?php // echo $form->field($model, 'diagnosis') ?>

    <?php // echo $form->field($model, 'rencanaasuhan') ?>

    <?php // echo $form->field($model, 'evaluasi') ?>

    <?php // echo $form->field($model, 'Column 10') ?>

    <?php // echo $form->field($model, 'ttd') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
