<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ApdinapSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apdinap-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tindakan') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'petugas') ?>

    <?= $form->field($model, 'handscoon') ?>

    <?php // echo $form->field($model, 'masker') ?>

    <?php // echo $form->field($model, 'apron') ?>

    <?php // echo $form->field($model, 'validator') ?>

    <?php // echo $form->field($model, 'patuh') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
