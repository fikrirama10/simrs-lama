<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UsgdetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usgdetail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idusg') ?>

    <?= $form->field($model, 'idpemeriksaan') ?>

    <?= $form->field($model, 'klinis') ?>

    <?= $form->field($model, 'hasil') ?>

    <?php // echo $form->field($model, 'tgl') ?>

    <?php // echo $form->field($model, 'nousg') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
