<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PengaduanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengaduan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nomer') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'nohp') ?>

    <?php // echo $form->field($model, 'pengaduan') ?>

    <?php // echo $form->field($model, 'tgl') ?>

    <?php // echo $form->field($model, 'idjenispengaduan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
