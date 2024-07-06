<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PpiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ppi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'momen1') ?>

    <?= $form->field($model, 'momen2') ?>

    <?= $form->field($model, 'momen3') ?>

    <?= $form->field($model, 'momen4') ?>

    <?php // echo $form->field($model, 'momen5') ?>

    <?php // echo $form->field($model, 'ipcln') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'person') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
