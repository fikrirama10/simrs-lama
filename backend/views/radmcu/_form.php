<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Radmcu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="radmcu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idrad')->textInput() ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'usia')->textInput() ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dokter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kesan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'klinis')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hasil')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nofoto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
