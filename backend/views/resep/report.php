<?php
    use common\models\Pasien;
    use common\models\Rawatjalan;
    use common\models\Dokter;
?>
<div class="trx" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
	<div class='header-kunjungan'>
	<div class='header-kunjungan-judul'>
		<div class="header-kunjungan-judul-au">
		PANGKALAN TNI AU SULAIMAN<br>RUMAH SAKIT
		</div>
		
	</div>
	

</div>
<div class='judul-kunjungan'><br>
	<b>Daftar Resep Pasien <?php if($judul == 1){echo'Rawat Jalan';}else if($judul == 2){echo'Rawat Inap';}else{echo'UGD';} ?></b>
	
	</div>
<br>
<table class="table">
    <tr>
        <th>No</th>
        <th>RM</th>
        <th>Nama</th>
        <th>Tgl Resep</th>
        <th>Bayar</th>
        <th>Total Resep</th>
    </tr>
    <?php $no=1; foreach($transaksi as $tr){ ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $tr->norm ?></td>
        <td><?= $tr->nama ?></td>
        <td><?= $tr->tgl ?></td>
        <td><?= $tr->bayar->jenisbayar ?></td>
        <td><?= $tr->total ?></td>
    </tr>
    <?php } ?>
</table>
</div>
</div>
