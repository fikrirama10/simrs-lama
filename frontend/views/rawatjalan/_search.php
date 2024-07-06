<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RawatjalanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rawatjalan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'iddokter') ?>

    <?= $form->field($model, 'idpoli') ?>

    <?php // echo $form->field($model, 'idbayar') ?>

    <?php // echo $form->field($model, 'iddiagnosa') ?>

    <?php // echo $form->field($model, 'tgldaftar') ?>

    <?php // echo $form->field($model, 'penanggung') ?>

    <?php // echo $form->field($model, 'alamat_penanggung') ?>

    <?php // echo $form->field($model, 'hubungan') ?>

    <?php // echo $form->field($model, 'notlp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
