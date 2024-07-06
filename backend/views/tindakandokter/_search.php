<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TindakandokterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tindakandokter-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode_rawat') ?>

    <?= $form->field($model, 'idtindakan') ?>

    <?= $form->field($model, 'tarif') ?>

    <?= $form->field($model, 'penindak') ?>

    <?php // echo $form->field($model, 'ditindakoleh') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
