<?php
$url = 'http://192.168.1.26/simrs/api/pasienagamaw?awal='.$start.'&akhir='.$end.'';
        $content = file_get_contents($url);
        $json = json_decode($content, true);
$url2 = 'http://192.168.1.26/simrs/api/pasienalaw?awal='.$start.'&akhir='.$end.'';
        $ank = file_get_contents($url2);
        $json2 = json_decode($ank, true);
$url3 = 'http://192.168.1.26/simrs/api/pasienkelamin?awal='.$start.'&akhir='.$end.'';
        $bdh = file_get_contents($url3);
        $json3 = json_decode($bdh, true);
$url4 = 'http://192.168.1.26/simrs/api/pasienulima?awal='.$start.'&akhir='.$end.'';
        $bdh2 = file_get_contents($url4);
        $js4 = json_decode($bdh2, true);
	$noa=1;
	$nob=1;
	$noc=1;
	$nod=1;
?>
<center><h2>Demografi Pasien <?= date('d/F/Y',(strtotime($start))) ?> s/d <?= date('d/F/Y',(strtotime($end)))?></h2></center>
<div class='hea0 olab'>
<div class='hea1'>
<h3>Berdasarkan Jenis Agama</h3>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Jenis Agama</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < count($json); $a++){ ?>
		<tr>
		<td><?= $noa++ ?></td>
		<td><?= $json[$a]['Pasien'] ?></td>
		<td><?= $json[$a]['Agama'] ?></td>
		</tr>
	<?php } ?>
</table>
</div>
<div class='headd1'>
<h3>Berdasarkan Usia</h3>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Rentang Usia</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < count($js4); $a++){ ?>
		<tr>
		<td><?= $nod++ ?></td>
		<td><?= $js4[$a]['Usia'] ?></td>
		<td><?= $js4[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
</table>
</div>
<div class='hea1'>
<h3>Berdasarkan Kelurahan</h3>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Kelurahan</th>
		<th>Jumlah</th>
	</tr>
	<?php if(count($json2) < 10 ){?>
	<?php for($a=0; $a < count($json2); $a++){ ?>
		<tr>
		<td><?= $nob++ ?></td>
		<td><?= $json2[$a]['Kel'] ?></td>
		<td><?= $json2[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
	<?php }else{ ?>
	<?php for($a=0; $a < 10; $a++){ ?>
		<tr>
		<td><?= $nob++ ?></td>
		<td><?= $json2[$a]['Kel'] ?></td>
		<td><?= $json2[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
	<?php } ?>
	
</table>
</div>
<div class='headd1'>
<h3>Berdasarkan Jenis Kelamin</h3>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Jenis Kelamin</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < count($json3); $a++){ ?>
		<tr>
		<td><?= $noc++ ?></td>
		<td><?= $json3[$a]['Kelamin'] ?></td>
		<td><?= $json3[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
</table>
</div>

</div>