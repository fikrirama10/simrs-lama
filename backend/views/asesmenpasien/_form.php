<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use kartik\checkbox\CheckboxX;
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
	<?=$form->field($model, 'sempel', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Sampel'); 
	?>
	
	<div class='box box-body'>
	<hr>
		<div class='col-md-4 col-xs-12'>
			<?=$form->field($model, 'anamesisi', [
				'template' => '{input}{label}{error}{hint}',
				'labelOptions' => ['class' => 'cbx-label']
				])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Anamesis'); 
			?>
			<?=$form->field($model, 'ass_psiko', [
				'template' => '{input}{label}{error}{hint}',
				'labelOptions' => ['class' => 'cbx-label']
				])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Assesmen Psikokongtif'); 
			?>
			
			<?=$form->field($model, 'rx_fisik', [
				'template' => '{input}{label}{error}{hint}',
				'labelOptions' => ['class' => 'cbx-label']
				])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Pemerikasaan Fisik'); 
			?>
			<?=$form->field($model, 'penunjang', [
				'template' => '{input}{label}{error}{hint}',
				'labelOptions' => ['class' => 'cbx-label']
				])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Pemerikasaan Penunjang'); 
			?>
			
		</div>
		<div class='col-md-4 col-xs-12'>
		<?=$form->field($model, 'diagnosis', [
				'template' => '{input}{label}{error}{hint}',
				'labelOptions' => ['class' => 'cbx-label']
				])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Diagnosis'); 
		?>
		<?=$form->field($model,'rencanaasuhan', [
				'template' => '{input}{label}{error}{hint}',
				'labelOptions' => ['class' => 'cbx-label']
				])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Rencana Asuhan'); 
		?>
		<?=$form->field($model,'evaluasi', [
				'template' => '{input}{label}{error}{hint}',
				'labelOptions' => ['class' => 'cbx-label']
				])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Evaluasi Post Tindakan'); 
		?>
		<?=$form->field($model,'ttd', [
				'template' => '{input}{label}{error}{hint}',
				'labelOptions' => ['class' => 'cbx-label']
				])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Evaluasi Post Tindakan'); 
		?>
			
		</div>
	
	</div>
	
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
