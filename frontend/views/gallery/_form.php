<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\checkbox\CheckboxX;
use yii\helpers\ArrayHelper;
use common\models\GaleryAlbum;
?>

<div class="galery-form">
	<div class='row'>
		<div class='col-sm-6'>
			<div class='panel panel-default'>
				<div class='panel-body'>
				
					<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
					<?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>
					<?= $form->field($model, 'gambar')->widget(FileInput::classname(), [
						'options' => ['accept' => 'Image/*'],
						'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]]);
					?>
					<?= $form->field($model, 'deskripsi')->textArea(['rows' => 3]) ?>
					<?=$form->field($model, 'tampilkan', [
						'template' => '{input}{label}{error}{hint}',
						'labelOptions' => ['class' => 'cbx-label']
						])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Tampilkan'); 
					?>
					<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? 'Upload' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
