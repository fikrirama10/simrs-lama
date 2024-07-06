<?php
	use common\models\KategoriTindakan;
	$kattindakan = KategoriTindakan::find()->all();
	$no=1;
?>
<div style='width:100%; text-align:center; '>
	<div style='width:100%;'>
		<div style='width:20%; border-bottom:1px solid; padding-bottom:5px;'>
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>

</div>
<div class='judul-kunjungan'>
	<b>LAPORAN BULANAN <br>JUMLAH PENGOBATAN PENYAKIT GIGI DAN MULUT </b>
	<br>  <?= $title ?>
</div>
	<div class='pengunjungg'> 
	<table class='table table-bordered'>
		<tr >
					<th align=center rowspan="2">No</th>
					<th align=center rowspan="2">Golongan</th>
					<th align=center rowspan="2">Macam Pengobatan</th>
					
					<th colspan="3">TNI AU</th>
					<th colspan="3">TNI AD</th>
					<th colspan="3">TNI AL</th>
					<th align=center rowspan="2">BPJS </th>
					<th align=center rowspan="2">Yanmas</th>
					<th align=center rowspan="2">Jumlah</th>
				</tr>
				<tr>
					<!-- TNI AU -->
					<th scope="col">M</th>
					<th scope="col">S</th>
					<th scope="col">K</th>
					<!-- TNI AD -->
					<th scope="col">M</th>
					<th scope="col">S</th>
					<th scope="col">K</th>
					<!-- TNI AL -->
					<th scope="col">M</th>
					<th scope="col">S</th>
					<th scope="col">K</th>
					
				</tr>
		<?php foreach($kattindakan as $kt): 
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/print-pengobatan-gigi?kat='.$kt->id.'&start='.$start.'&end='.$end;
			$content = file_get_contents($url);
			$json = json_decode($content, true);
			
		?>
		<tr>
			<td rowspan="<?= count($json)+1 ?>"><?= $no++ ?></td>
			<td rowspan="<?= count($json)+1 ?>"> <?= $kt->kategori ?> </td> 
			
			
		</tr>
		<?php  for($a=0; $a < count($json); $a++){ ?>
		<tr>			
			<td><?= $json[$a]['Nama'] ?></td>
			<td><?= $json[$a]['TniauMil'] ?></td>
			<td><?= $json[$a]['TniauSip'] ?></td>
			<td><?= $json[$a]['TniauKel'] ?></td>
			
			<td>0</td>
			<td>0</td>
			<td>0</td>
			
			<td>0</td>
			<td>0</td>
			<td>0</td>
			
			<td><?= $json[$a]['Bpjs'] ?></td>
			<td><?= $json[$a]['Yanmas'] ?></td>
			<td><?= $json[$a]['Jumlah'] ?></td>					
		</tr>
		<?php } ?>
		
		<?php endforeach; ?>
	</table>
	
	</div> 
