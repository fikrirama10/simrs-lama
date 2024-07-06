<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\InaprmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inaprm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'tglpulang') ?>

    <?= $form->field($model, 'tglskembali') ?>

    <?= $form->field($model, 'pengembalian') ?>

    <?php // echo $form->field($model, 'kelengkapan') ?>

    <?php // echo $form->field($model, 'validator') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
