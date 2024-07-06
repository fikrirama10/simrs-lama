<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Transaksimanual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksimanual-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idtrx')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'usia')->textInput() ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
