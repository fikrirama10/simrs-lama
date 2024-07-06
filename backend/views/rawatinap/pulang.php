<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\Rawatjalan;
use common\models\KategoriMelahirkan;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Diagnosaranap;
use kartik\date\DatePicker;
use kartik\date\DateTimePicker;
$diag = Diagnosaranap::find()->where(['idrawat'=>$model->idrawat])->all();
$no = 1;
$masuk = date('Y-m-d',strtotime($model->tglmasuk));
?>
<?= $masuk ?>
<div class='box box-body'>
			<h4><?= $model->pasien->sbb ?>, <?= $model->pasien->nama_pasien?> ( <?= $model->pasien->jenis_kelamin?> )</h4>
			<a style='color:grey;'>RM: <?= $model->no_rekmed ?> <b>|</b> No Rawat: <?= $model->idrawat?></a>
			<h6><?= $model->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($model->pasien->tanggal_lahir)) ?> ,<?=$model->pasien->usia?> th</h6>
			<hr>
			<a style='color:grey;'><?= $model->pasien->alamat?></a><br>
			<a style='color:grey;'><?= $model->pasien->nohp?></a><br>
</div>
<div class='box box-body'>
	<h4>Dokter Ruangan</h4>
	<?php if($model->iddokter == null){echo'-';}else{ ?>
			<h5><?= $model->dokter->namadokter ?></h5>
			<?php } ?><hr>
	<h4>Diagnosa</h4>
		<table class='table table-bordered'>
					<tr>
						<td>No</td>
						<td>Diagnosa</td>
						<td>Jenis Diagnosa</td>
						<td>#</td>
						
					</tr>
					<?php foreach($diag as $nosa): ?>
					<tr>
						<td><?= $no++?></td>
						<td><?= $nosa->kadiagnosa?></td>
						<td><?= $nosa->jenisdiag->jenis ?></td>
						<td><a href='<?= Url::to(['rawatinap/deletediag/'.$nosa->id]) ?>'><span class="label label-danger"><i class="fa fa-close"></i></span></a></td>
						
					</tr>
					<?php endforeach; ?>
				</table>
				
				<?php $form = ActiveForm::begin(); ?>	
				<br>
				<?php if($model->iddokter == 5 || $model->iddokter == 39){ ?>
					<?= $form->field($model, 'status_melahirkan')->dropDownList(ArrayHelper::map(KategoriMelahirkan::find()->all(), 'id', 'kategori'),['prompt'=>'- Jenis Kelahiran -'])->label('Jenis Kelahiran')?>
				<?php } ?>
				<?=	$form->field($model, 'tglkeluar')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					
						'pluginOptions' => [
						//'autoclose'=>true,
						'format' => 'yyyy-mm-dd',
						'required'=>true,
						'todayHighlight' => true,
						 'autoclose'=>true,
						'startDate' => $masuk,
					]
					])->label('Tanggal Keluar');?>
				<?= $form->field($model, 'carakeluar')->dropDownList(['Sehat' => 'Sehat', 'Berobat Jalan' => 'Berobat Jalan', 'Meninggal' => 'Meninggal', 'Di rujuk' => 'Di rujuk'  , 'APS' => 'APS'])->label("Kondisi Pulang") ?>
				<?= $form->field($model, 'ketpulang')->textarea(['rows' => 5])->label('Keterangan Pulang') ?>
				<?= Html::submitButton('Pulang', ['class' => 'btn btn-success']) ?>
				<?php ActiveForm::end(); ?>
</div>
