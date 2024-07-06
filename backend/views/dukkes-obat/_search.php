<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DukkesObatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dukkes-obat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kodeobat') ?>

    <?= $form->field($model, 'namaobat') ?>

    <?= $form->field($model, 'stok') ?>

    <?= $form->field($model, 'kadaluarsa') ?>

    <?php // echo $form->field($model, 'jenisobat') ?>

    <?php // echo $form->field($model, 'idsatuan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
