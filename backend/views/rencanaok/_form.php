<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Rencanaok */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rencanaok-form">

    <?php $form = ActiveForm::begin(); ?>
	<?=	$form->field($model, 'jadwaloprasi')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>
   
	<?= $form->field($model, 'catatan')->widget(CKEditor::className(), [
						'options' => ['rows' => 3],
						'preset' => 'standard'
					])->label('Catatan') ?>


    <?= $form->field($model, 'kdig')->textinput(['placeholder' => 'KODE DIAGNOSA','onkeyup'=>'$.get("'.Url::toRoute('tes/listdiagnosa/').'",{ id: $(this).val() }).done(function( data ) 
									{
										  $( "select#rencanaok-diagnosa" ).html( data );
										  });']) ?>
				<select id="rencanaok-diagnosa" class="form-control" name='Rencanaok[diagnosa]' aria-invalid="false">
			
				</select>
   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
