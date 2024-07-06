<?php
use yii\widgets\ActiveForm;

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\web\View;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanRanap */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaan Ranaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class='box box-body'>
			<div class='col-md-6'>
				<h5>Detail Pasien</h5>
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
					<span class="input-group-addon" id="basic-addon1">Tanggal Masuk</span>
					<input type='text' class='form-control' readonly value='<?= date('Y/m/d',strtotime($rajal->tglmasuk)) ?>  '>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Ruangan</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->kamar->namaruangan?>'>
					<span class="input-group-addon" id="basic-addon1">Penjamin</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->carabayar->jenisbayar?>'>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">DPJP</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->dokter->namadokter?>'>
					
				</div>
				
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nomor RM</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->no_rekmed ?>'>
						<span class="input-group-addon" id="basic-addon1">Nomer Register</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->idrawat ?>'>
				</div>
				<hr>
				<h5>Pemeriksaan Pasien Rawat Inap</h5>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Keadaan Umum</span>
					<textarea type='text' class='form-control' rows='4' readonly><?= $model->keadaanumum ?></textarea>	
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Kondisi Pasien :</span>
					<textarea type='text' class='form-control' rows='4' readonly><?= $model->keadaanfisik ?></textarea>	
				</div>
				<div class='row'>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Tekanan Darah' name='PemeriksaanRanap[td]' value='<?= $model->td ?> mmHg' readonly id="pemeriksaanranap-td"><span class="input-group-addon" id="basic-addon1">Tekanan Darah</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Nadi' value='<?= $model->nadi ?> x / menit' readonly ><span class="input-group-addon" id="basic-addon1">Nadi</span>
						</div>
					</div>
					
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Respirasi' value='<?= $model->respirasi ?> x / menit' readonly ><span class="input-group-addon" id="basic-addon1">Respirasi</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Suhu'value='<?= $model->suhu ?> C' readonly ><span class="input-group-addon" id="basic-addon1">Suhu</span>
						</div>
					</div>
				</div><br>
				
			
			</div>
			<div class='col-md-6'>
			<h5>Tindakan Dan Obat Obatan</h5>
				<?php $form = ActiveForm::begin(); ?>
				<?=	$form->field($model, 'tindakan[]')->widget(Select2::className(),
								[
									'data'=>  common\models\Tarif::getOptions($rajal->idbayar),
									'options' => [
										'tags' => true,
										'multiple' => true
									],
								]
							)->label('Tindakan / tarif Dokter');
						?>
				<?= $form->field($model, 'detailtindakan')->textarea(['rows'=>4])->label('Detail Tindakan yang di lakukan')  ?>
				
				<?=	$form->field($model, 'obat[]')->widget(Select2::className(),
								[
									'data'=>  common\models\Obat::getOptions($rajal->idbayar),
									'options' => [
										'tags' => true,
										'multiple' => true
									],
								]
							)->label('Nama Obat');
				?>
				<?= $form->field($model, 'detailobat')->textarea(['rows'=>4])->label('Detail Obat / Therapy')  ?>
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
				<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				<?php ActiveForm::end(); ?>
				<hr>
				<?php if($model->status == 2){ ?>
					<a href='<?= Url::to(['/rawatinap/'.$rajal->id])?>'  class="btn btn-success pull-right " >Selesai</a>	
				<?php } ?>
			</div>
</div>
<?php 
$tindakan = ($model->tindakan)?$model->tindakan:'';
$obat= ($model->obat)?$model->obat:'';
$lab= ($model->lab)?$model->lab:'';
$radiologi= ($model->radiologi)?$model->radiologi:'';


$this->registerJs("
	var tindakan = $('#pemeriksaanranap-tindakan').val();
	var obat = $('#pemeriksaanranap-obat').val();
	var lab = $('#pemeriksaanranap-lab').val();
	var radiologi = $('#pemeriksaanranap-radiologi').val();
	
	/*ini untuk selected input select2*/
	if(tindakan !== null && obat !== null && lab !== null && radiologi !== null){
		$('#pemeriksaanranap-tindakan').val(".$tindakan.").trigger('change');
		$('#pemeriksaanranap-obat').val(".$obat.").trigger('change');
		$('#pemeriksaanranap-lab').val(".$lab.").trigger('change');
		$('#pemeriksaanranap-radiologi').val(".$radiologi.").trigger('change');
		
	}
	


", View::POS_READY);

 ?>

