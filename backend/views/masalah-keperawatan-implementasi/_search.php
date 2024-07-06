<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MasalahKeperawatanImplementasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="masalah-keperawatan-implementasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'iduser') ?>

    <?= $form->field($model, 'jam') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'idimplementasi') ?>

    <?php // echo $form->field($model, 'implementasi') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
