<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use yii\jui\AutoComplete;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Csep */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="csep-form">
<div class='box box-body'>
 <?php $form = ActiveForm::begin(); ?>
	 <?= $form->field($model, 'jnsPelayanan')->dropDownList([ 2 => 'Rawat Jalan', 1 => 'Rawat Inap', ], ['prompt' => '']) ?>
	   
   
    <?=	$form->field($model, 'tglSEP')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd',
					'todayHighlight' => true,
					      'autoclose'=>true,
					'endDate' => "0d"
					]
					])->label(false)?>

	<?php if($pasien == null){ ?>
	<?= $form->field($model, 'noKartu')->textInput(['maxlength' => true]) ?>

	<?php }else{?>
	 <?= $form->field($model, 'noKartu')->textInput(['maxlength' => true,'value'=>$pasien->nobpjs,'readonly'=>true]) ?>
	<?php } ?>
    <?= $form->field($model, 'faskes')->textinput(['placeholder' => 'Faskes','onkeyup'=>'$.get("'.Url::toRoute('tes/ppkpel/').'",{ id: $(this).val() }).done(function( data ) 
									{
										  $( "select#diagnosa-pasien" ).html( data );
										  });'])->label(false) ?>
	<select id="diagnosa-pasien" class="form-control" name='Csep[ppkPelayanan]' aria-invalid="false">
			
	</select><br>

   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
   

</div>
