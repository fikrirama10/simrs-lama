<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DukkesKeluarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dukkes-keluar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kodetrx') ?>

    <?= $form->field($model, 'tgl') ?>

    <?= $form->field($model, 'iduser') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'kegiatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
