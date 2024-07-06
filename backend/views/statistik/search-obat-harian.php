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
$nama = array();
$id = array();
foreach($json2 as $tr){
	array_push($id,$tr['id']);
	array_push($nama,$tr['Nama']);
	array_push($jumlah,$tr['Jumlah']);
}
 ?>
<?= ChartJs::widget([
    'type' => 'bar',
    'options' => [
        'height' => 150,
        'width' => 400
    ],
    'data' => [
        'labels' => $nama,
        'datasets' => [
            [
				
               'label' => "10 Besar Pengeluaran Obat",
                'backgroundColor' => "rgba(0,137,233,1)",
                'borderColor' => "rgba(0,137,233,1)",
                'pointBackgroundColor' => "rgba(0,137,233,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(0,137,233,1)",
                'data' => $jumlah,
            ],
            
        ]
    ],
	
]);
?>