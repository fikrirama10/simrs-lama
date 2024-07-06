<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanRanap */
/* @var $form yii\widgets\ActiveForm */
?>

   <div class='box box-body'>
			<?php $form = ActiveForm::begin(); ?>
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
				<?= $form->field($model, 'keadaanumum')->textarea(['rows'=>4])->label('Keadaan Umum Pasien')  ?>
				<?= $form->field($model, 'keadaanfisik')->textarea(['rows'=>4])->label('Kondisi Fisik')  ?>
				<div class='row'>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Tekanan Darah' name='PemeriksaanRanap[td]' id="pemeriksaanranap-td"><span class="input-group-addon" id="basic-addon1">mmHg</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Nadi' name='PemeriksaanRanap[nadi]' id="pemeriksaanranap-nadi"><span class="input-group-addon" id="basic-addon1">x / menit</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Respirasi' name='PemeriksaanRanap[respirasi]' id="pemeriksaanranap-respirasi"><span class="input-group-addon" id="basic-addon1">x / menit</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Suhu' name='PemeriksaanRanap[suhu]' id="pemeriksaanranap-suhu"><span class="input-group-addon" id="basic-addon1">C</span>
						</div>
					</div>
				</div><br>
				<?= $form->field($model, 'jam')->widget(TimePicker::classname(), ['pluginOptions' => [
						'showSeconds' => false,
						'showMeridian' => false,
						'minuteStep' => 1,
						'secondStep' => 5,
					]])->label('Jam Pemeriksaan'); ?>
				<div class="form-group">
					<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
				</div>

    <?php ActiveForm::end(); ?>

</div>
</div>

