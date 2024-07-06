<?php 
	$no = 1;
?>
<div class='judul-kunjungan'>
<BR>
	<b>ABSENSI PESERTA VAKSIN COVID 19 RSAU LANUD SULAIMAN</b><br>
	Tanggal : <?= $tgl ?> - Vaksin Ke : <?= $vaksin ?>
</div>
<div class='pengunjung'>
	<table class='table table-bordered' style='text-align:center;'>
		<tr>
			<th width=10px>No</th>
			<th>No Register</th>
			<th >Nama</th>
			<th >No Telp</th>
			<th width=10px>Usia</th>
			<th>Jadwal Vaksin</th>
			<th width=10px>Vaksin</th>
			<th width=60px>TTD</th>
		</tr>
		<?php foreach($kuota as $k){ ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $k['noregistrasi'] ?></td>
			<td><?= $k['nama'] ?></td>
			<td><?= $k['nohp'] ?></td>
			<td><?= $k['usia'] ?></td>
			<td><?= $k['tglvaksin'] ?></td>
			<td><?= $k['vaksin'] ?></td>
			<td></td>
		</tr>
		<?php } ?>
	</table>
</div>