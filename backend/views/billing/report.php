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
	<b>Daftar Masuk Pasien <?php if($judul == 1){echo'Rawat Jalan';}else if($judul == 2){echo'Rawat Inap';}else{echo'UGD';} ?></b>
	
	</div>
<br>
<table class="table">
    <tr>
        <th>No</th>
        <th>RM</th>
        <th>Nama</th>
        <th>Tgl Masuk</th>
        <th>Tgl Keluar</th>
        <th>Bayar</th>
    </tr>
    <?php $no=1; $los=0; foreach($transaksi as $tr){ 
        $los += $tr->rawat->lamarawat;
    $pasien = Pasien::find()->where(['no_rekmed'=>$tr->no_rm])->one();
    $rawat = Rawatjalan::findOne($tr->idrawat);
    ?>
    <?php if($pasien) {?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $pasien->no_rekmed ?></td>
        <td><?= $pasien->nama_pasien ?></td>
        <td><?= date('d/m/Y' ,strtotime($tr->rawat->tglmasuk)) ?></td>
        <td><?= date('d/m/Y' ,strtotime($tr->tglbayar)) ?></td>
        <td><?= $tr->bayar->jenisbayar ?></td>
    </tr>
    <?php } ?>
    
    <?php } ?>
    
</table>
</div>
</div>
