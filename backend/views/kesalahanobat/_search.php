<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KesalahanobatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kesalahanobat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'rm') ?>

    <?= $form->field($model, 'jumlahjenis') ?>

    <?= $form->field($model, 'bentuksediaan') ?>

    <?php // echo $form->field($model, 'dosis') ?>

    <?php // echo $form->field($model, 'aturan') ?>

    <?php // echo $form->field($model, 'komposisi') ?>

    <?php // echo $form->field($model, 'kesalahan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
