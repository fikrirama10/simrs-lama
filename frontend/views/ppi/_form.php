<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\unit;
use common\models\Ipcln;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Ppi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ppi-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class='box box-body'>
	 <?= $form->field($model, 'unit')->dropDownList(ArrayHelper::map(Unit::find()->all(), 'id', 'unit'),['prompt'=>'- Pilih Unit -'])->label('Dokter',['class'=>'label-class'])->label()?>

	<?= $form->field($model, 'ipcln')->dropDownList(ArrayHelper::map(Ipcln::find()->all(), 'id', 'nama'),['prompt'=>'- Pilih Ipcln -'])->label('Dokter',['class'=>'label-class'])->label()?>

    
	<?= $form->field($model, 'person')->textInput(['maxlength' => true]) ?>
		<div class='col-md-2 col-xs-12'>
			<label><h5>Momen 1</h5></label>
			<?= $form->field($model, 'momen1')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'momen1')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-2 col-xs-12'>
			<label><h5>Momen 2</h5></label>
			<?= $form->field($model, 'momen2')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'momen2')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-2 col-xs-12'>
			<label><h5>Momen 3</h5></label>
			<?= $form->field($model, 'momen3')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'momen3')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-2 col-xs-12'>
			<label><h5>Momen 4</h5></label>
			<?= $form->field($model, 'momen4')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'momen4')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-2 col-xs-12'>
			<label><h5>Momen 5</h5></label>
			<?= $form->field($model, 'momen5')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'momen5')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
	</div>
   
   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
