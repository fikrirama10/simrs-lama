<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TrxmanualSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trxmanual-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'trxid') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'tgl') ?>

    <?= $form->field($model, 'ket') ?>

    <?php // echo $form->field($model, 'casier') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
