<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AntibiotikSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="antibiotik-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'diagnosa') ?>

    <?php // echo $form->field($model, 'jenisae') ?>

    <?php // echo $form->field($model, 'dilakukan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
