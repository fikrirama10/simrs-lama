<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PengeluaranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengeluaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'trxid') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'jabatan') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'biaya') ?>

    <?php // echo $form->field($model, 'casier') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
