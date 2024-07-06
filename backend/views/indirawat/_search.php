<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\IndirawatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indirawat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'diagnosa') ?>

    <?= $form->field($model, 'dpjptcp') ?>

    <?= $form->field($model, 'pkmcp') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'verived') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
