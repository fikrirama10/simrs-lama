<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use common\models\Jenisbayar;
use common\models\Dokter;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\Poli;
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */

//$this->title = $model->no_rekmed;
$this->params['breadcrumbs'][] = ['label' => 'Pasien  > Rawat Jalan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class='box box-body'>
	<h3>Verifikasi Pasien</h3><hr>
	<h6><b>Data Pasien</b></h6>
	<h4><?= $model->pasien->sbb ?>, <?= $model->pasien->nama_pasien?> ( <?= $model->pasien->jenis_kelamin?> )
		</h4>
		
			<a style='color:grey;'>RM: <?= $model->no_rekmed ?> <b>|</b> No Reg: <?= $model->noregistrasi?></a>
			<h6><?= $model->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($model->pasien->tanggal_lahir)) ?> ,<?=$model->pasien->usia?> th</h6>
			<hr>
			<a style='color:grey;'><?= $model->pasien->alamat?></a><br>
			<a style='color:grey;'><?= $model->pasien->nohp?></a><br>
</div>
<div class='box box-body'>
	<h6><b>Rawat Jalan</b></h6>
	<h4><?= $model->polii->namapoli?></h4>
	 <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($rawatjalan, 'no_rekmed')->textInput(['value'=>$model->no_rekmed]) ?>
	<?= $form->field($lograwat, 'rm')->hiddeninput(['value'=>$model->no_rekmed])->label(false) ?>
	<?= $form->field($rawatjalan, 'idbayar')->hiddeninput(['value'=>$model->idbayar])->label(false) ?>
	<?= $form->field($rawatjalan, 'idpoli')->hiddeninput(['value'=>$model->idpoli])->label(false) ?>
	<?= $form->field($rawatjalan, 'norujukan')->hiddeninput(['value'=>$model->norujukan])->label(false) ?>
	<?= $form->field($rawatjalan, 'tgldaftar')->hiddeninput(['value'=>date('Y-m-d G:i:s',strtotime($model->tglberobat))])->label(false) ?>

	 <?= $form->field($rawatjalan, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->where(['idpoli'=>$model->idpoli])->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label()?>
	 <div class='row'>
		 <div class='col-md-12'>
			<input type="checkbox"  name="Rawatjalan[anggota]" id="lengkap" value="1"> Anggota
		 </div>
	 </div>
	 <br>
	<?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
						
			
<?php ActiveForm::end();  ?>
</div>