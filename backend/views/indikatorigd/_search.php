<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\IndikatorigdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indikatorigd-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'namapetugas') ?>

    <?= $form->field($model, 'bls') ?>

    <?= $form->field($model, 'blsterbit') ?>

    <?= $form->field($model, 'blshabis') ?>

    <?php // echo $form->field($model, 'ppgd') ?>

    <?php // echo $form->field($model, 'ppgdterbit') ?>

    <?php // echo $form->field($model, 'ppgdhabis') ?>

    <?php // echo $form->field($model, 'gels') ?>

    <?php // echo $form->field($model, 'gelsterbit') ?>

    <?php // echo $form->field($model, 'gelshabis') ?>

    <?php // echo $form->field($model, 'als') ?>

    <?php // echo $form->field($model, 'alsterbit') ?>

    <?php // echo $form->field($model, 'alshabis') ?>

    <?php // echo $form->field($model, 'ket') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
