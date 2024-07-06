<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AiskbcSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aiskbc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'sesuaiindikasi') ?>

    <?= $form->field($model, 'apdtepat') ?>

    <?php // echo $form->field($model, 'alatsteril') ?>

    <?php // echo $form->field($model, 'hh') ?>

    <?php // echo $form->field($model, 'dilepas') ?>

    <?php // echo $form->field($model, 'pengisianbalon') ?>

    <?php // echo $form->field($model, 'fiksasi') ?>

    <?php // echo $form->field($model, 'urine') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
