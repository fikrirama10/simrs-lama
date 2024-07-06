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
	<?=$form->field($model, 'cukurclipper', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Cukur Dengan e.clipper'); 
	?>
 	<?=$form->field($model, 'waktucukur', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Waktu Cukur (± 2jam)'); 
	?>
 	<?=$form->field($model, 'mandi', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Mandi cholrexidine'); 
	?>
 	<?=$form->field($model, 'antibiotic', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Antibiotic 1 jam sebelum insisi'); 
	?>
 	<?=$form->field($model, 'tdkinfeksi', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Pasien tidak sedang infeksi'); 
	?>
    <?=$form->field($model, 'kontrolgula', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Gula Darah Terkontrol'); 
	?>

   
   
   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
