<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Indirawat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indirawat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diagnosa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dpjptcp')->textInput() ?>

    <?= $form->field($model, 'pkmcp')->textInput() ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'verived')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
