<?php
$hitung = count($json);
$hitung2 = count($json2);
use yii\helpers\Url;
use yii\web\View;
?>
<h4>Belum terbayar	</h4>
<table class='table table-sm table-hover table-bordered'>
	<thead>
		<tr>
			<th>No Rekmed</th>
			<th>No Rawat</th>
			<th>Nama Pasien</th>
			<th>Tanggal Daftar</th>
			<th>Jenis Rawat</th>
			<th>Jenis Bayar</th>
			<th>Poliklinik</th>
		</tr>
	</thead>
	<tbody>
		<?php if($hitung < 1){ ?>
		<tr class="bg-danger">
			<td colspan=7><div class="empty">Data Tidak Ada</div></td>
		</tr>
		<?php }else{ ?>
		<?php $no=1; for($a=0; $a < count($json); $a++){ ?>		
		<tr>
			<td><?= $json[$a]['NoRm'] ?></td>
			<?php if($json[$a]['IdJenis'] == 2){ ?>
			<td><a href='<?= Url::to(['cassa/uppulang/'.$json[$a]['Id']]) ?>'><?= $json[$a]['IdRawat'] ?></a></td>
			<?php }else{ ?>
			<td><a href='<?= Url::to(['billing/create/'.$json[$a]['Id']]) ?>'><?= $json[$a]['IdRawat'] ?></a></td>
			<?php } ?>
			<td><?= $json[$a]['Nama'] ?></td>
			<td><?= $json[$a]['TglDaftar'] ?></td>
			<td><?= $json[$a]['JenisRawat'] ?></td>
			<td><?= $json[$a]['JenisBayar'] ?></td>
			<td><?= $json[$a]['Poliklinik'] ?></td>
		</tr>
		<?php } ?>
		<?php } ?>
	</tbody>
</table>
<hr>
<h4>Riwayat Bayar</h4>
<table class='table table-hover table-bordered'>
	<thead>
		<tr>
			<th>No Rekmed</th>
			<th>Nama Pasien</th>
			<th>Tanggal Daftar</th>
			<th>Jenis Rawat</th>
			<th>Jenis Bayar</th>
			<th>Poliklinik</th>
			<th>Total</th>
			<th>#</th>
		</tr>
	</thead>
	<tbody>
		<?php if($hitung2 < 1){ ?>
		<tr>
			<td style='background-color:#f33a3a; color:#fff;' colspan=8><div class="empty">Data Tidak Ada</div></td>
		</tr>
		<?php }else{ ?>
		<?php for($a=0; $a < count($json2); $a++){ ?>		
		<tr>
			<td><?= $json2[$a]['NoRm'] ?></td>
			<td><?= $json2[$a]['Nama'] ?></td>
			<td><?= $json2[$a]['TglDaftar'] ?></td>
			<td><?= $json2[$a]['JenisRawat'] ?></td>
			<td><?= $json2[$a]['JenisBayar'] ?></td>
			<td><?= $json2[$a]['Poliklinik'] ?></td>
			<td>Rp. <?= Yii::$app->algo->IndoCurr($json2[$a]['Total']) ?></td>
			<td><a id='confirm' target='_blank' href='<?= Url::to(['cassa/print/'.$json2[$a]['Id']]) ?>'><span class="label label-warning"><i class="fa fa-print"></i></span></a></td>
		</tr>
		<?php } ?>
		<?php } ?>
	</tbody>
</table>

<?php 
$this->registerJs("

$('#confirm').on('click', function(event){
	age =  prompt('Masukan Kode Verifikasi?', );
	if(age == '3321'){
       return true;
    } else {
        event.preventDefault();
        return false;
    }
});

", View::POS_READY);
?>
