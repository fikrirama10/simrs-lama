<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KlpcmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="klpcm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'dpjp') ?>

    <?= $form->field($model, 'ruangan') ?>

    <?php // echo $form->field($model, 'ket') ?>

    <?php // echo $form->field($model, 'tdklengkap') ?>

    <?php // echo $form->field($model, 'jform') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
