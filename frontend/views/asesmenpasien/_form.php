<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Asesmenpasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asesmenpasien-form">

    <?php $form = ActiveForm::begin(); ?>
		<?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>
    <?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'sempel')->dropDownList([ 1 => 'Ya', 0 => 'Tidak', ], ['prompt' => 'Sempel']) ?>
	<div class='box box-body'>
		<div class='col-md-4 col-xs-12'>
			<label><h3>Anamesis</h3></label>
			<?= $form->field($model, 'anamesisi')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'anamesisi')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-4 col-xs-12'>
			<label><h3>Assesmen Psikokongtif</h3></label>
			<?= $form->field($model, 'ass_psiko')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'ass_psiko')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-4 col-xs-12'>
			<label><h3>Pemerikasaan Fisik</h3></label>
			<?= $form->field($model, 'rx_fisik')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'rx_fisik')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
	</div>
	<div class='box box-body'>
		<div class='col-md-4 col-xs-12'>
			<label><h3>Pemerikasaan Penunjang</h3></label>
			<?= $form->field($model, 'penunjang')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'penunjang')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-4 col-xs-12'>
			<label><h3>Diagnosis</h3></label>
			<?= $form->field($model, 'diagnosis')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'diagnosis')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
		<div class='col-md-4 col-xs-12'>
			<label><h3>Rencana Asuhan</h3></label>
			<?= $form->field($model, 'rencanaasuhan')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
			<?= $form->field($model, 'rencanaasuhan')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
		</div>
	
	</div>
	<div class='box box-body'>
	<div class='col-md-4'>
	<label><h3>Evaluasi Post Tindakan</h3></label>
	<?= $form->field($model, 'evaluasi')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
	<?= $form->field($model, 'evaluasi')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
	</div>
	<div class='col-md-4'>
	<label><h3>TTD DPJP UGD</h3></label>
	<?= $form->field($model, 'ttd')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
	<?= $form->field($model, 'ttd')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
	</div>
	</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
