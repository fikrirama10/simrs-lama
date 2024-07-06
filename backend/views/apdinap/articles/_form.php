<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ArticlesCategory;
use common\models\ArticlesPublish;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">
	<div class='row'>

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
		<div class='col-md-8'>

				<?= $form->field($model, 'Title')->textInput(['maxlength' => true,'class' => 'form-control bold']) ?>
				<?= $form->field($model, 'SubTitle')->textInput(['maxlength' => true]) ?>
								
				<?= $form->field($model, 'Content')->widget(CKEditor::className(), [
					'options' => ['rows' => 6],
					'preset' => 'standard'
				]) ?>
				
				
				<?= $form->field($model, 'Intro')->textArea(['rows' => 5]) ?>
				<?= $form->field($model, 'Created')->hiddenInput(['value'=>date('Y-m-d')])->label(false); ?>
				<?= $form->field($model, 'UserId')->hiddenInput(['value'=>''])->label(false); ?>
				
				<div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
		</div>
		<div class='col-md-4'>
			<?= $form->field($model, 'IdCat')->dropDownList(ArrayHelper::map(ArticlesCategory::find()->all(), 'IdCat', 'Category'))->label('Kategori',['class'=>'label-class'])?>
			

			
			<?= $form->field($model, 'IdBlock')->hiddenInput(['value'=>'1'])->label(false); ?>
			<?= $form->field($model, 'IsStatic')->hiddenInput(['value'=>'0'])->label(false); ?>
			<?= $form->field($model, 'IsFeatured')->hiddenInput(['value'=>'0'])->label(false); ?>
			<?= $form->field($model, 'Picture')->widget(FileInput::classname(), [
				'options' => ['accept' => 'Picture/*'],
				'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]]);?>

			<?= $form->field($model, 'IsHeadLine')->hiddenInput(['value'=>'0'])->label(false); ?>
			<?= $form->field($model, 'Tags')->textArea(['rows' => 5]) ?>
			<?= $form->field($model, 'SEO')->hiddenInput(['value'=>''])->label(false); ?>
			<?= $form->field($model, 'ReadCount')->hiddenInput(['value'=>'0'])->label(false); ?>
			<?= $form->field($model, 'LastUpdate')->hiddenInput(['value'=>'0'])->label(false); ?>

		</div>

    <?php ActiveForm::end(); ?>
	</div>
</div>
