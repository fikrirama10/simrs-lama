<?php
use yii\helpers\Url;
use yii\web\View;
?>
<div id='pasien-ajax' class='box box-body'>
<h4>Cek Kepesertaan Pasien</h4>
<p>Masukan Nomor BPJS pasien</p>
<div class='row'>
	<div class='col-md-6'>
		<input type='text' class='form-control' id='nobpjs' name='nobpjs'><br>
		<a id="show-all" class="btn btn-success" ><span class="fa fa-search" style="width: 20px;"></span>Cari</a>
	</div>
	<div class='col-md-6'>
	
	</div>
</div>
	
</div>
<div class='box box-body'>
<h3>Detail Peserta</h3>
	<p><?= $kelas['nama']?></p>
	<p><?= $kelas['hakKelas']['keterangan']?></p>
	<p><?= $kelas['jenisPeserta']['keterangan']?></p>
	<p><?= $kelas['mr']['noTelepon']?></p>	
	<p><?= $kelas['nik']?></p>
	<p><?= $kelas['noKartu']?> ( <?= $kelas['mr']['noMR']?> )</p>
	<p>
		<?php if($kelas['statusPeserta']['kode'] > 0){?>
		<span class="label label-danger"><?= $kelas['statusPeserta']['keterangan']?></span>
		<?php }else{ ?>
		<span class="label label-success"><?= $kelas['statusPeserta']['keterangan']?></span>
		<?php } ?>
	</p>
</div>
<?php 
$urlShowAll = Url::to(['bpjs/show-all']);
$this->registerJs("
	
	$('#show-all').on('click',function(){
	
			nobpjs = $('#nobpjs').val();
			
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