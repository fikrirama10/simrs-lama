<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pengaduan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengaduan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nohp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengaduan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tgl')->textInput() ?>

    <?= $form->field($model, 'idjenispengaduan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
