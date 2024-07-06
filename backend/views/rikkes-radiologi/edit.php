<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Mcutni */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nofoto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomer_tes')->textInput(['maxlength' => true])->label("No Casis") ?>

    <?= $form->field($model, 'usia')->textInput() ?>
	<button type="button" id="tsb" class="btn btn-info" ><i class='fa fa-search'></i>Template</button>
	<?= $form->field($model, 'pemeriksaan')->textArea(['rows' => 6]) ?>
	<?= $form->field($model, 'kesan')->textArea(['rows' => 6]) ?>
	<?= $form->field($model, 'kualifikasi')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
					
$this->registerJs("

	$('#tsb').on('click',function(){
	    $('#rikkesradiologidetail-pemeriksaan').val('Cor tidak mebesar. Sinuses, dan diafragma normal . Pulmo :-	Hili normal.-	Corakan bronkhovaskuler normal.- Tidak tampak pebercakan.');
		$('#rikkesradiologidetail-kesan').val('Pulmo tidak tampak kelainan. Tidak tampak kardiomegali');});
	
	
", View::POS_READY);
?>