<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DaftaronlineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daftaronline-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idpoli') ?>

    <?= $form->field($model, 'kuota') ?>

    <?= $form->field($model, 'user') ?>

    <?= $form->field($model, 'tanggal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
