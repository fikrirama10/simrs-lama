
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model common\models\Aidobc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aidobc-form">

<div class='box box-body'>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>
	<?=$form->field($model, 'sesuaiindikasi', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Pemasangan sesuai indikasi'); 
	?>

 	<?=$form->field($model, 'apdtepat', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('APD tepat'); 
	?>
 	<?=$form->field($model, 'alatsteril', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Pemasangan menggunakan alat steril'); 
	?>
 	<?=$form->field($model, 'hh', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Hand Hygiene'); 
	?>
    <?=$form->field($model, 'dilepas', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Segera dilepas jika tidak indikasi'); 
	?>
   <?=$form->field($model, 'pengisianbalon', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Pengisian balon sesuai (30ml)'); 
	?>
  <?=$form->field($model, 'fiksasi', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Fiksasi kateter dengan plester'); 
	?>
	 <?=$form->field($model, 'urine', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Urine menggantung'); 
	?>

   
     

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
