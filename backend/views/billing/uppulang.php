
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Tindakan;
use yii\helpers\ArrayHelper;
use common\models\Resepdokter;
use kartik\select2\Select2;
use common\models\Rawatjalan;
use common\models\Lab;
use common\models\Trandokter;
use common\models\Trandetail;
use common\models\Transaksi;
use yii\helpers\Url;
use kartik\date\DatePicker;

?>
<div class='box'>
	<div class='box box-header'>
		<h4>Pembayaran</h4>
	</div>
	<div class='box box-body'>
		<table class='table table-bordered'>
			<tr>
				<th width=200>Nama Pasien</th>
				<td width=10>:</td>
				<td><?= $model->pasien->sbb?>.<?= $model->pasien->nama_pasien?></td>
			</tr>
			<tr>
				<th width=200>No RM</th>
				<td width=10>:</td>
				<td><?= $model->no_rekmed?></td>
			</tr>
			<tr>
				<th width=200>Id Rawat</th>
				<td width=10>:</td>
				<td><?= $model->idrawat?></td>
			</tr>
			<tr>
				<th width=200>Jenis Rawat</th>
				<td width=10>:</td>
				<td><?= $model->jerawat->jenisrawat?></td>
			</tr>
			<tr>
				<th width=200>Cara Bayar</th>
				<td width=10>:</td>
				<td><?= $model->carabayar->jenisbayar?></td>
			</tr>
			<tr>
				<th width=200>Tanggal Register</th>
				<td width=10>:</td>
				<td><?= date('Y / m / d',strtotime($model->tgldaftar))?></td>
			</tr>
			<?php if($model->idjenisrawat == 1){?>
			<tr>
				<th width=200>Cara Bayar</th>
				<td width=10>:</td>
				<td><?= $model->polii->namapoli?></td>
			</tr>
			<?php }else if($model->idjenisrawat == 2){ ?> 
			<tr>
				<th width=200>Kelas Rawat</th>
				<td width=10>:</td>
				<td><?= $model->kelas->namakelas?></td>
			</tr>
			<tr>
				<th width=200>Tanggal Masuk</th>
				<td width=10>:</td>
				<td><?= date('Y / m / d',strtotime($model->tglmasuk))?></td>
			</tr>
			<?php }else{ ?>
			
			<?php }?>
		</table>
		<hr>
		<div class='row'>
		<div class='col-md-6'>
		 <?php $form = ActiveForm::begin(); ?>
			
			<?php if($model->idjenisrawat == 2 ){  ?>
			<?= $form->field($model, 'tglkbayar')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label('Tanggal pulang')?>
			<?php }else{?>
			<div class="input-group">
			<input type='hidden' class='form-control' name="Rawatjalan[tglkbayar]" value='<?= date('Y-m-d',strtotime($model->tgldaftar))?>' readonly>
					
			<span class="input-group-addon" id="basic-addon1">Tanggal Pulang</span>	
			<input type='text' id='rawatjalan-drbayar'  class='form-control' value='<?= date('Y-m-d',strtotime($model->tgldaftar))?>' readonly>
			</div>
			<?php } ?>
			<hr>
			 <?= $form->field($model, 'drbayar')->dropDownList(ArrayHelper::map(Trandokter::find()->all(), 'id', 'namadokter') ,['prompt' => 'Pilih Dokter','required'=>true])->label('Kode Dokter')?>
		
			<?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
		 <?php ActiveForm::end(); ?>
		</div>
		<div class='col-md-6'>
		<div class="alert alert-warning" role="alert">
					<h3>Perhatian !!! </h3>
					<p>- Jika pasien Rawat Inap pastikan <b>Tanggal Pulang terisi</b>  </p>
					<p>- Kode dokter harus diisi </p>
					<p>- Jika sudah tekan update jangan tekan kembali ke halaman ini </p>
					<br>
				</div>
		</div>
	</div>
	</div>
</div>