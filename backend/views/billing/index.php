<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\View;
?>

<div class='box'>
	<div class='box-header'>
		<h4>Billing Pasien</h4>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='col-md-6'>
			<div class="alert alert-info" role="alert">
					<h3>Petunjuk </h3>
					<p>- Masukan Nomer Rekam Medis Pasien </p>
					<p>- Jika Data ditemukan akan tampil di bagian bawah </p>
					<p>- klik pada nomer rawat untuk memilih data pasien </p>
					<br>
				</div>
				<div class='form-group'>
					<label> Masukan Nomer Rekam Medis Pasien </label>
					<input id='pasien-nobpjs' type='text' class='form-control'>
					<br>
					<a id="show-all" class="btn btn-success" ><span class="fa fa-search" style="width: 20px;"></span>Cari</a>
				</div>
			</div>
			<div class='col-md-6'>
				<h4>Transaksi Hari ini</h4>
				<table class='table table-bordered'>
					<tr>
						<th>Jenis Bayar</th>
						<th>Belum Bayar</th>
						<th><a href='<?= Url::to(['billing/databayar']) ?>' target='_blank' >Selesai</th>
					</tr>
					<tr class="bg-info">
						<th><a href='#' data-toggle="modal" data-target="#mdYanmasum">Yanmasum</a></th>
						<td><?= $json['TrxBelumUmum'] ?></td>
						<td><?= $json['TrxSelesaiUmum'] ?></td>
					</tr>
					<tr class="bg-success">
						<th><a href='#' data-toggle="modal" data-target="#mdYanmasum">BPJS</a></th>
						<td><?= $json['TrxBelumBpjs'] ?></td>
						<td><?= $json['TrxSelesaiBpjs'] ?></td>
					</tr>
				</table>
			</div>
		</div>
		<hr>
		<div class='row'>
			<div class='col-md-12'>				
				<div id='pasien-ajax'>	
				</div>
			</div>
		</div>
	</div>

</div>

<?php 

Modal::begin([
	'id' => 'mdYanmasum',
	'header' => '<h3>Pilih Pasien</h3>',
	'size'=>'modal-lg',
	'options'=>[
		'data-url'=>'transaksi',
	],
]);

echo '<div class="modalContent">'. $this->render('_dataYanmasum', ['dataBpjs'=>$dataBpjs,'dataYanmas'=>$dataYanmas]).'</div>';
 
Modal::end();

Modal::begin([
	'id' => 'mdBpjs',
	'header' => '<h3>Pilih Template</h3>',
	'size'=>'modal-lg',
	'options'=>[
		'data-url'=>'transaksi',
	],
]);

echo '<div class="modalContent">'.$this->render('_dataBpjs', ['dataBpjs'=>$dataBpjs, ]).'</div>';
 
Modal::end();


$urlShowAll = Url::to(['billing/show-all']);
$this->registerJs("
	
	$('#show-all').on('click',function(){
	
			nobpjs = $('#pasien-nobpjs').val();
			
			$.ajax({
				type: 'GET',
				url: '{$urlShowAll}',
				data: 'id='+nobpjs,
				success: function (data) {

					
					$('#pasien-ajax').html(data);
					
					console.log(data);
					
				},
			});
		
	});


	
           
	

", View::POS_READY);
?>

