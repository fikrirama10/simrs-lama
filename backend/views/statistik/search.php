<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\web\View;
$no=1;

		$jumlah = array();
		$diagnosa = array();
		foreach($json2 as $tr){
			array_push($jumlah,$tr['Jumlah']);
			array_push($diagnosa,$tr['Diagnosa']);
		}
 ?>	
 <div class='row'>
<div class='col-md-6'>
<?= ChartJs::widget([
    'type' => 'bar',
    'options' => [
        'height' => 400,
        'width' => 400
    ],
    'data' => [
        'labels' => $diagnosa,
        'datasets' => [
            [
                'label' => "10 Penyakit Terbanyak",
                'backgroundColor' => "rgba(0,137,233,1)",
                'borderColor' => "rgba(0,137,233,1)",
                'pointBackgroundColor' => "rgba(0,137,233,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(0,137,233,1)",
                'data' => $jumlah,
            ],
            
        ]
    ]
]);
?>
</div>
<div class='col-md-6'>

	<hr>
	<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Diagnosa</th>
			<th>Jumlah</th>
		</tr>
		<?php foreach($json2 as $tr){?>
		<tr>
			<td><?= $no++?></td>
			<td><?= $tr['Nama']?></td>
			<td><?= $tr['Jumlah']?></td>
		</tr>
		<?php } ?>
	</table>
</div>
</div>