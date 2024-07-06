<?php
use common\models\Kartustok;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Url;
use kartik\date\DatePicker;


$keluar = array();
$masuk = array();
$hari = array();
foreach($json2 as $tr){
			array_push($keluar,$tr['keluar']);
			array_push($hari,$tr['hari']);
			array_push($masuk,$tr['masuk']);
		}
?>
 <?php
			$start = (isset($_GET['start']))? $_GET['start'] : date('m');
			$end = (isset($_GET['end']))? $_GET['end'] : date('Y');
			$cek = (isset($_GET['cek']))? $_GET['cek'] : 'today';
			?>

<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 140,
        'width' => 400
    ],
    'data' => [
        'labels' => $hari,
        'datasets' => [
            [
                'label' => "Barang Keluar",
                'backgroundColor' => "rgba(255,99,132,0.2)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => $keluar
            ],
            [
                'label' => "Barang Masuk",
				'backgroundColor' => "rgba(179,181,198,0.2)",
                'borderColor' => "rgba(179,181,198,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                
                'data' => $masuk
            ]
        ]
    ]
]);
?><hr>
<p>Resep Keluar = <?= $resep ?> R/</p>
<p>Obat Keluar = <?= $jumlah ?> <?= $model->satuan->satuan ?></p>
<p>Rata Rata Obat Keluar = <?= $rata ?> <?= $model->satuan->satuan ?></p>
<hr>
<p>Mutasi Stok</p>
<table class='table table-bordered'>
	<tr>
		<th>Tanggal</th>
		<th>Jenis Mutasi</th>
		<th>Jumlah</th>
		<th>Stok Awal</th>
		<th>Stok Masuk</th>
		<th>Stok Keluar</th>
		<th>Stok Akhir</th>
	</tr>
	<?php foreach($kartustok as $ks): ?>
	<tr>
		<td><?= $ks->tgl ?></td>
		<td><?= $ks->mutasi->jenismutasi ?></td>
		<td><?= $ks->qty ?></td>
		<td><?= $ks->stokawal ?></td>
		<td><?= $ks->stokmasuk ?></td>
		<td><?= $ks->stokkeluar ?></td>
		<td><?= $ks->stokakhir ?></td>
	</tr>
	<?php endforeach; ?>
	
</table>

