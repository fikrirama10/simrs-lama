<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use common\models\DokumenKategori;
use common\models\DokumenJenis;
use common\models\DokumenType;
use common\models\DokumenStatus;
use common\models\Skpd;
use yii\web\View ;
/* @var $model common\models\Dokumen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dokumen-form">
	<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
	<div class='panel panel-default'>
		<div class='panel-heading'>
			<h4>
				<?= Html::encode($this->title);?>
			</h4>
		</div>
		<div class='panel-body'>
			<div class='row'>
				<div class='col-sm-8'>
					<?= $form->field($model, 'Judul')->textInput(['maxlength' => true, 'class' => 'form-control bold']) ?>

					<?= $form->field($model, 'Deskripsi')->widget(CKEditor::className(), [
						'options' => ['rows' => 6],
						'preset' => 'standard'
					])->label('Kandungan Informasi') ?>

						
					
					
					
				</div>
				<div class='col-sm-4'>
					<?= $form->field($model, 'IdKat')->dropDownList(ArrayHelper::map(DokumenKategori::find()->all(), 'Id', 'Kategori'),['prompt'=>'- Pilih Kategori -'])->label('Kategori',['class'=>'label-class'])?>
					<div id='kattt'>
					<?= $form->field($model, 'IdJenis')->dropDownList(ArrayHelper::map(DokumenJenis::find()->all(), 'Id', 'Jenis'),['prompt'=>'- Pilih Jenis -'])->label('Jenis',['class'=>'label-class'])?>
					</div>
					<?= $form->field($model, 'IdType')->dropDownList(ArrayHelper::map(DokumenType::find()->all(), 'Id', 'Type'))->label('Type',['class'=>'label-class'])?>
					
					<?= $form->field($model, 'FileName')->widget(FileInput::classname(), [
						'options' => ['accept' => 'FileName/*'],
						'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png','pdf','xps','doc','docx','xls','xlsx','ppt','pptx','rar','zip','jpeg','mp3','wav','txt']]]);?>
						
					<?= $form->field($model, 'Keterangan')->textArea(['rows' => 3]) ?>
					<?= $form->field($model, 'IdStat')->dropDownList(ArrayHelper::map(DokumenStatus::find()->all(), 'Id', 'Status'))->label('Status Dokumen',['class'=>'label-class'])?>
				</div>
				
			</div>
		</div>
		<div class='panel-footer'>
			<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Proses' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		</diV
	</div>
	<?php ActiveForm::end(); ?>
    
</div>
<?php 
$this->registerJs("

	

", View::POS_READY);
?>