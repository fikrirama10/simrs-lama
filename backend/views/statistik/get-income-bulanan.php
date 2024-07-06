<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SuplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;

		$data = $json2['data'];
		$label = $json2['label'];
$umum=array();
$bpjs=array();
foreach($data as $tr){
	array_push($umum,$tr['JumlahUmum']);
	array_push($bpjs,$tr['JumlahBpjs']);
}

// print_r($bpjs);
?>
<h3>Grafik Data Pendapatan Pasien <?= $title ?></h3>
<a href='<?= Url::to(['statistik/income-harian']) ?>'>Detail Grafik Harian</a>
<div class="col-md-12">

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
                'label' => "Income Umum",
                'backgroundColor' => "rgba(255,99,132,0.5)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => $umum[0]
            ],
			
            [
                'label' => "Income Bpjs",
                'backgroundColor' => "rgba(179,181,198,0.5)",
                'borderColor' => "rgba(179,181,198,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => $bpjs[0],
            ],
            
        ]
    ],
	'clientOptions' => [
		'responsive' => true,
	],
]);
?>
</div>