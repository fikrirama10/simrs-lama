<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PrlabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prlab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idjenis') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'jamdiambil') ?>

    <?php // echo $form->field($model, 'jamhasil') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
