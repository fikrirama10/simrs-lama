<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model common\models\Mcutni */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nofoto')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'notes')->textInput(['maxlength' => true])->label("No Casis") ?>	
    <?= $form->field($model, 'usia')->textInput() ?>
	<button type="button" id="testb" class="btn btn-info" data-toggle="modal" data-target="#mdTemplate"><i class='fa fa-search'></i>Template</button>
	<?= $form->field($model, 'pemeriksaan')->textArea(['rows' => 6]) ?>
	<?= $form->field($model, 'kesan')->textArea(['rows' => 6]) ?>
	<?= $form->field($model, 'kualifikasi')->textInput() ?> 

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<?php
					
$this->registerJs("

	
	$('#testb').on('click',function(){
		$('#mcutni-pemeriksaan').val('Cor sinuses dan diafragma normal Pulmo : Hilli normal Corakan bronkhovaskuler normal. Tidak tampak infiltrat');
		$('#mcutni-kesan').val('Cor dan Pulmo tidak tampak kelainan');
		
	});
	
	
", View::POS_READY);
?>