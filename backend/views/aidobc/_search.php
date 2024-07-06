<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AidobcSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aidobc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'cukurclipper') ?>

    <?= $form->field($model, 'waktucukur') ?>

    <?php // echo $form->field($model, 'mandi') ?>

    <?php // echo $form->field($model, 'antibiotic') ?>

    <?php // echo $form->field($model, 'tdkinfeksi') ?>

    <?php // echo $form->field($model, 'kontrolgula') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
