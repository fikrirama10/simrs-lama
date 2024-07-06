<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TbSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_rm') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'usia') ?>

    <?= $form->field($model, 'tgl_lahir') ?>

    <?php // echo $form->field($model, 'berat_badan') ?>

    <?php // echo $form->field($model, 'tinggi_badan') ?>

    <?php // echo $form->field($model, 'ktp') ?>

    <?php // echo $form->field($model, 'bpjs') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'jenis_pasien') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
