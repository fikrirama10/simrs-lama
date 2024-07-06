
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\web\View;

$igd=array();
$ri=array();
$rj=array();
$data = $json2['data'];
$label = $json2['label'];
foreach($data as $tr){
	array_push($igd,$tr['JumlahIGD']);
	array_push($rj,$tr['JumlahRJ']);
	array_push($ri,$tr['JumlahRI']);
}

?>
<h3>Data Kunjungan Pasien <?= $json2['tahun'] ?></h3>
<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 200,
        'width' => 500
    ],
    'data' => [
        'labels' => $label,
        'datasets' => [
            [
                'label' => "Rawat Jalan",
                'backgroundColor' => "rgba(179,181,198,0.1)",
                'borderColor' => "rgba(179,181,198,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => $rj[0],
            ],
            [
                'label' => "Rawat Inap",
                'backgroundColor' => "rgba(255,99,132,0.1)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => $ri[0]
            ],
			[
                'label' => "UGD",
                'backgroundColor' => "rgba(166,250,157,0.1)",
                'borderColor' => "rgba(166,250,157,1)",
                'pointBackgroundColor' => "rgba(166,250,157,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(rgba(166,250,157,1)",
                'data' => $igd[0]
            ]
        ]
    ]
]);
?>