<?php
use yii\widgets\ActiveForm;
use common\models\PemeriksaanUgddiagsekunder;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\web\View;
use kartik\select2\Select2;
use common\models\PemeriksaanUgdResep;
use common\models\Tarif;
$obat = PemeriksaanUgdResep::find()->where(['idpemeriksaan'=>$model->id])->all();
$no=1;
/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanIgd */
$sekunder = PemeriksaanUgddiagsekunder::find()->where(['idpemeriksaan'=>$model->id])->all();
$sc = PemeriksaanUgddiagsekunder::find()->where(['idpemeriksaan'=>$model->id])->count();
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaan Igds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
<div class='box-body'>
			<div class='col-md-6'>
				<h5>Detail Pasien  	<?php if($rajal->status == 7){ ?>
		    	<a href='<?= Url::to(['asesmen/igdrawat/'.$rajal->id])?>' class="btn btn-danger pull-right btn-md">Rawat </a>	
				<?php } ?></h5>
				<hr>
				Data Pasien
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nama Pasien</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->pasien->sbb ?>.<?= $rajal->pasien->nama_pasien ?> ,(<?= $rajal->pasien->usia ?> th)'>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Tanggal Lahir</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->pasien->tanggal_lahir ?>'>
					<span class="input-group-addon" id="basic-addon1">Alamat</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->pasien->alamat ?>'>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Tanggal Register</span>
					<input type='text' class='form-control' readonly value='<?= date('Y/m/d',strtotime($rajal->tgldaftar)) ?> ( <?= date('H:i a',strtotime($rajal->tgldaftar))?>) '>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Jenis Rawat</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->jerawat->jenisrawat?>'>
					<span class="input-group-addon" id="basic-addon1">Penjamin</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->carabayar->jenisbayar?>'>
					
				</div>
				
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nomor RM</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->no_rekmed ?>'>
						<span class="input-group-addon" id="basic-addon1">Nomer Register</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->idrawat ?>'>
				</div>
				<hr>
				
				<h5>Pemeriksaan UGD <a href='<?= Url::to(['pemeriksaan-ugd/update?id='.$model->id]) ?>'><span class="label label-success"><i class="fa fa-pencil"></i></span></a></h5>
				
				Pemeriksaan Fisik 
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Dokter Pemeriksa</span>
					<?php if($rajal->iddokter == null){echo'Dokter kosong';}else{ ?>
					<input type='text' class='form-control' readonly value='<?= $rajal->dokter->namadokter ?>'>
					<?php } ?>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Keluhan Utama</span>
					<input type='text' class='form-control' readonly value='<?= $model->keluhanutama ?>'>						
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Riwayat Penyakit</span>
					<input type='text' class='form-control' readonly value='<?= $model->rwpenyakit ?>'>	
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">TD</span>
					<input type='text' class='form-control' readonly value='<?= $model->td ?> mmHg'>	
					<span class="input-group-addon" id="basic-addon1">Nadi</span>
					<input type='text' class='form-control' readonly value='<?= $model->nadi ?> x/menit'>	
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Respirasi</span>
					<input type='text' class='form-control' readonly value='<?= $model->pernapasan ?> x/menit'>	
					<span class="input-group-addon" id="basic-addon1">Suhu</span>
					<input type='text' class='form-control' readonly value='<?= $model->suhu ?> ºC'>	
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Kepala</span>
					<textarea type='text' class='form-control' readonly><?= $model->ku_kepala ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Leher</span>
					<textarea type='text' class='form-control' readonly><?= $model->ku_leher ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Paru paru</span>
					<textarea type='text' class='form-control' readonly><?= $model->ku_tparu ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Jantung</span>
					<textarea type='text' class='form-control' readonly><?= $model->ku_tjantung ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Abdomen</span>
					<textarea type='text' class='form-control' readonly><?= $model->abdomen ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Kulit</span>
					<textarea type='text' class='form-control' readonly><?= $model->kulit ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Extremitas</span>
					<textarea type='text' class='form-control' readonly><?= $model->extremitas ?></textarea>
				</div><hr>
   
			</div>
			<div class='col-md-6'>
				
				<h5>Diagnosa</h5><hr>
				Diagnosa Primer
				<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Diagnosa</span>
						<input type='text' class='form-control' readonly value='<?= $rajal->kdiagnosa ?>'>
				</div><hr>
				Diagnosa Sekunder
				<?php if($sc > 0){ ?>
					<table class='table table-bordered' >
						<tr>
							<th>No</th>
							<th>Diagnosa Sekunder</th>
							
						</tr>
						<?php foreach($sekunder as $sk):?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $sk->diagnosasekunder ?></td>
						</tr>
						<?php endforeach; ?>
						
					</table>
				<?php }?>
				<a href='<?= Url::to(['diagnosa-sekunder/create?id='.$model->id])?>'  class="btn btn-primary " target='_blank'>+ Diagnosa Sekunder</a>	
				<h5>Tindak Lanjut</h5>
				
				<?php $form = ActiveForm::begin(); ?>
				<?=	$form->field($model, 'tindakan[]')->widget(Select2::className(),
								[
									'data'=>  common\models\Tarif::getOptions($rajal->idbayar),
									'options' => [
										'tags' => true,
										'multiple' => true
									],
								]
							)->label('Tindakan UGD');
						?>
			<a href='<?= Url::to(['pemeriksaan-ugd/resep?id='.$model->id])?>'  class="btn btn-success " target='_blank'>+ Resep</a>	
				<hr>
			<?php if($obat > 0){ ?>
					<table class='table table-bordered' >
						<tr>
							<th>No</th>
							<th>Obat</th>
							<th>Dosis</th>
							
						</tr>
						<?php foreach($obat as $ob):?>
						<tr>
							<td><?= $no++?></td>
							<td><?= $ob->obat->namaobat ?> ( <?= $ob->jumlah ?> <?= $ob->obat->satuan->satuan ?> )</td>
							<td><?= $ob->dosis ?></td>
							
						</tr>
						<?php endforeach; ?>
						
					</table>
				<?php } ?>
				<?=	$form->field($model, 'lab[]')->widget(Select2::className(),
								[
									'data'=>  common\models\Kattindakanlab::getOptions(),
									'options' => [
										'tags' => true,
										'multiple' => true
									],
								]
							)->label('Laboratorium');
				?>
				<?=	$form->field($model, 'radiologi[]')->widget(Select2::className(),
								[
									'data'=>  common\models\Dafrad::getOptions(),
									'options' => [
										'tags' => true,
										'multiple' => true
									],
								]
							)->label('Radiologi');
				?>
				<?= $form->field($model, 'prosedur')->dropDownList([ 'Bedah'=>'Bedah','Non Bedah' => 'Non Bedah' ], ['prompt' => 'Jenis Kegiatan','required'=>true])->label(false) ?>
				<?= $form->field($model, 'statuspasien')->dropDownList([ 'Pulang'=>'Pulang','Dirawat' => 'Dirawat', 'Dirujuk' => 'Dirujuk', 'Meninggal' => 'Meninggal' ], ['prompt' => 'Status Pasien','required'=>true])->label(false) ?>
				 <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				<?php ActiveForm::end(); ?>
				<hr>
				<?php if($rajal->status == 7){ ?>
				<a href='<?= Url::to(['/rawatjalan/igd2/'])?>'  class="btn btn-success pull-right " >Selesai</a>	
				<?php } ?>
			</div>
			
</div>
<hr>
<div class='box-footer'>

</div>
</div>
<?php 
$tindakan = ($model->tindakan)?$model->tindakan:'';
$obat= ($model->obat)?$model->obat:'';
$lab= ($model->lab)?$model->lab:'';
$radiologi= ($model->radiologi)?$model->radiologi:'';


$this->registerJs("
	var tindakan = $('#pemeriksaanigd-tindakan').val();
	var obat = $('#pemeriksaanigd-obat').val();
	var lab = $('#pemeriksaanigd-lab').val();
	var radiologi = $('#pemeriksaanigd-radiologi').val();
	
	/*ini untuk selected input select2*/
	if(tindakan !== null && obat !== null && lab !== null && radiologi !== null){
		$('#pemeriksaanigd-tindakan').val(".$tindakan.").trigger('change');
		$('#pemeriksaanigd-obat').val(".$obat.").trigger('change');
		$('#pemeriksaanigd-lab').val(".$lab.").trigger('change');
		$('#pemeriksaanigd-radiologi').val(".$radiologi.").trigger('change');
		
	}
	


", View::POS_READY);

 ?>
