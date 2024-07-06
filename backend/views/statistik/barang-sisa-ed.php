
<div class='box box-body'>
	<h4>Barang Sisa akan Kadaluarsa</h4>
	<hr>
	<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Nama Barang</th>
			<th>ED</th>
			<th>Sisa Stok Lama</th>
		</tr>
		<?php $no=1; for($a=0; $a < count($json2); $a++){ ?>
			<?php
				$tglAwal = strtotime(date('Y-m-d'));
				$tglAkhir = strtotime($json2[$a]['SisaED']);
				$jeda = abs($tglAkhir - $tglAwal);
				$diff = floor($jeda/86400 + 1);

			?>
			<?php if($diff < 60){ ?>
			<tr style='background-color:red;'>
			<?php }else{echo'<tr>';} ?>
				<td><?= $no++ ?></td>
				<td><?= $json2[$a]['Nama'] ?></td>
				<td><?= $json2[$a]['SisaED'] ?> - (<?= $diff ?> hari)</td>
				<td><?= $json2[$a]['StokLama'] ?></td>
			</tr>
		<?php } ?>
	</table>
</div>
<div class='box box-body'>
	<h4>Kadaluarsa Barang</h4>
	<hr>
	<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Nama Barang</th>
			<th>ED</th>
			<th>Sisa Stok</th>
		</tr>
		<?php $no2=1; foreach($obat as $ob): ?>
			<?php
				$tglAwala = strtotime(date('Y-m-d'));
				$tglAkhira = strtotime($ob->kadaluarsa);
				$jedaa = abs($tglAkhira - $tglAwala);
				$diffa = floor($jedaa/86400 + 1);

			?>
			<?php if($diffa < 101){ ?>
			<tr>
			<td><?= $no2++ ?></td>
			<td><?= $ob->namaobat ?></td>
			<td><?= $ob->kadaluarsa ?>  (<?= $diffa ?> hari)</td>
			<td><?= $ob->stok - $ob->sisastok ?></td>
			</tr>
			<?php }else{echo'<tr></tr>';}?>
			
		<?php endforeach; ?>
		
	</table>
</div>