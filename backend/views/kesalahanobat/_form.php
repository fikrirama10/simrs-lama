<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Kesalahanobat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kesalahanobat-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'rm')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'jumlahjenis')->textInput() ?>
		<div class='col-md-2 col-xs-12'>
			<label><h5>Bentuk Sediaan</h5></label>
			<?= $form->field($model, 'bentuksediaan')->radio(['label' => 'Salah', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'bentuksediaan')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-2 col-xs-12'>
			<label><h5>Dosis Obat</h5></label>
			<?= $form->field($model, 'dosis')->radio(['label' => 'Salah', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'dosis')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-2 col-xs-12'>
			<label><h5>Aturan Pakai</h5></label>
			<?= $form->field($model, 'aturan')->radio(['label' => 'Salah', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'aturan')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-2 col-xs-12'>
			<label><h5>Komposisi Obat</h5></label>
			<?= $form->field($model, 'komposisi')->radio(['label' => 'Salah', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'komposisi')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
