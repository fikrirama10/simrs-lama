<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\unit;
use common\models\Ipcln;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
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
		<?=$form->field($model, 'momen1', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Momen 1'); 
	?>

		<?=$form->field($model, 'momen2', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Momen 2'); 
	?>

	<?=$form->field($model, 'momen3', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Momen 3'); 
	?>

		<?=$form->field($model, 'momen4', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Momen 4'); 
	?>
	
		<?=$form->field($model, 'momen5', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Momen 5'); 
	?>
		
	</div>
   
   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
