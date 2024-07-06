<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GalerySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="galery-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'IdAlb') ?>

    <?= $form->field($model, 'Judul') ?>

    <?= $form->field($model, 'Gambar') ?>

    <?= $form->field($model, 'Deskripsi') ?>

    <?php // echo $form->field($model, 'IsShow') ?>

    <?php // echo $form->field($model, 'UploadTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
