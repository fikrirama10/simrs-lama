<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\JadwaloprasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwaloprasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

   
    <?= $form->field($model, 'no_rekmed') ?>

    <?php // echo $form->field($model, 'jenistindakan') ?>

    <?php // echo $form->field($model, 'idpoli') ?>

    <?php // echo $form->field($model, 'terlaksana') ?>

    <?php // echo $form->field($model, 'idbayar') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
