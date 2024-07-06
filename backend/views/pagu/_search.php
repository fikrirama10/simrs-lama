<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PaguSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'jenispagu') ?>

    <?= $form->field($model, 'kodepagu') ?>

    <?= $form->field($model, 'nilaipagu') ?>

    <?= $form->field($model, 'tahun') ?>

    <?php // echo $form->field($model, 'iduser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
