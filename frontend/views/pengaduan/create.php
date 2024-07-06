<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Jenispengaduan;
use common\models\Penilaian;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PengaduanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengaduan Rsau dr.Norman T.Lubis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengaduan-index"  style='margin-bottom:20px;'>
	<br>
	<br>
	<br>
	<br>
    <center><h1><?= Html::encode($this->title) ?></h1></center>
	<br>
	<br>
	<br>
	<div class='container bg-light' style='border:1px solid #EEE;'>
		<?php $form = ActiveForm::begin(); ?>
		<div class='row' style='padding-top:15px;'>
			<div class='col-md-12'><h4>PENGADUAN MASYARAKAT</h4></div>
			<div class='col-md-12'>
				<div class='row bg-primary'style='padding-top:15px;'>
					<div class='col-md-2 px-2'><h5>PENERIMA LAPORAN</h5></div>
					<div class='col-md-4'> <?= $form->field($model, 'nomer')->textInput(['maxlength' => true , 'placeholder'=>'HUMAS DAN PROTOKOLER','disable'=>true])->label(false) ?></div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class='row bg-primary'>
					<div class='col-md-2 px-2'><h5>JENIS LAPORAN</h5></div>
					<div class='col-md-3'> <?= $form->field($model, 'idjenispengaduan')->dropDownList(ArrayHelper::map(Jenispengaduan::find()->all(), 'id', 'jenispengaduan') ,['prompt' => 'Jenis Laporan'])->label(false)?></div>
				</div>
			</div>
			<div class='col-md-12'><h4>PELAPOR</h4></div>
			<div class='col-md-12'>
				<div class='row bg-success ' style='padding-top:15px;'>
					<div class='col-md-2 px-2'><h5>NAMA PELAPOR</h5></div>
					<div class='col-md-4'> <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label(false) ?> </div>
					<div class='col-md-1'>*Harap Diisi</div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class='row bg-success '>
					<div class='col-md-2 px-2'><h5>NO TELEPON / HP</h5></div>
					<div class='col-md-4'> <?= $form->field($model, 'nohp')->textInput(['maxlength' => true])->label(false) ?> </div>
					<div class='col-md-1'>*Harap Diisi</div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class='row bg-success '>
					<div class='col-md-2 px-2'><h5>EMAIL</h5></div>
					<div class='col-md-4'> <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?> </div>
					<div class='col-md-1'>*Harap Diisi</div>
				</div>
			</div>
				<div class='col-md-12'><h4>PENGADUAN</h4></div>
			<div class='col-md-12'>
				<div class='row bg-warning ' style='padding-top:15px;'>
					<div class='col-md-2 px-2'><h5>Deskripsi Pengaduan</h5></div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class='row bg-warning ' style='padding-top:15px;'>
					<div class='col-md-12'>
					<?= $form->field($model, 'pengaduan')->widget(CKEditor::className(), [
					'options' => ['rows' => 6],
					'preset' => 'standard'
				])->label(false) ?>
					</div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class='row bg-warning ' style='padding-top:15px;'>
					<div class='col-md-2 px-2'><h5>FOTO</h5></div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class='row bg-warning ' style='padding-top:15px;'>
					<div class='col-md-12'>
					<?= $form->field($model, 'foto')->widget(FileInput::classname(), [
				'options' => ['accept' => 'foto/*'],
				'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]])->label(false);?>
					</div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class='row bg-primary' style='padding-top:15px;'>
					<div class='col-md-2 px-2'><h5>Penilaian</h5></div>
					<div class='col-md-3'> <?= $form->field($model, 'idpenilaian')->dropDownList(ArrayHelper::map(Penilaian::find()->all(), 'id', 'penilaian') ,['prompt' => 'Jenis Penilaian'])->label(false)?></div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class='row bg-warning ' style='padding-top:15px;'>
					<div class='col-md-12'>
					<div class="form-group">
					<?= Html::submitButton('SIMPAN', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php ActiveForm::end(); ?>
	</div>
    
</div>
