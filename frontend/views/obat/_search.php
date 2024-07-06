<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ObatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="obat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'noobat') ?>
    <?= $form->field($model, 'namaobat') ?>

    <?php // echo $form->field($model, 'harga') ?>

    <?php // echo $form->field($model, 'idsatuan') ?>

    <?php // echo $form->field($model, 'idjenisobat') ?>

    <?php // echo $form->field($model, 'stok') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div><hr>
	
    <?php ActiveForm::end(); ?>

</div>
