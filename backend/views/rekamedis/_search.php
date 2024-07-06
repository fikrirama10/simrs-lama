<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RekamedisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rekamedis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'no_rekmed') ?>


    <?php // echo $form->field($model, 'tglpinjam') ?>

    <?php // echo $form->field($model, 'peminjam') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
