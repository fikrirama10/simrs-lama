<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\View;
$no=1;
$jumlah = array();
$nama = array();
$jumlah_rajal = array();
$nama_rajal = array();
$jumlah_ugd = array();
$nama_ugd = array();
$jumlah_ranap = array();
$nama_ranap = array();
foreach($json2 as $tr){
	array_push($nama,$tr['hari']);
	array_push($jumlah,$tr['income']);
}

foreach($json_rajal as $td){
	array_push($nama_rajal,$td['hari']);
	array_push($jumlah_rajal,$td['income']);
}

foreach($json_ugd as $tr){
	array_push($nama_ugd,$tr['hari']);
	array_push($jumlah_ugd,$tr['income']);
}

foreach($json_ranap as $tr){
	array_push($nama_ranap,$tr['hari']);
	array_push($jumlah_ranap,$tr['income']);
}
 ?>
 	<h4><?= $title ?></h4>
 <div class='row'>
 <div class='col-md-12'>
<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 150,
        'width' => 400
		
    ],
    'data' => [
        'labels' => $nama,
        'datasets' => [
            [
				
                'label' => $title,
                'backgroundColor' => "rgba(0,137,233,0.8)",
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
</div>

<div class='col-md-12'>
<div class='row'>

	<div class='col-md-6'>
		<?= ChartJs::widget([
			'type' => 'line',
			'options' => [
				'height' => 200,
				'width' => 400
				
			],
			'data' => [
				'labels' => $nama_rajal,
				'datasets' => [
					[
						
						'label' => "Grafik Income Rawat Jalan",
						'backgroundColor' => "rgba(245,66,87,0.8)",
						'borderColor' => "rgba(245,66,87,1)",
						'pointBackgroundColor' => "rgba(245,66,87,1)",
						'pointBorderColor' => "#fff",
						'pointHoverBackgroundColor' => "#fff",
						'pointHoverBorderColor' => "rgba(245,66,87,1)",
						'data' => $jumlah_rajal,
					],
					
					
				]
			],
			
		]);
		?>
	</div>
	<div class='col-md-6'>
		<?= ChartJs::widget([
			'type' => 'line',
			'options' => [
				'height' => 200,
				'width' => 400
				
			],
			'data' => [
				'labels' => $nama_ugd,
				'datasets' => [
					[
						
						'label' => "Grafik Income UGD",
						'backgroundColor' => "rgba(237,184,38,0.8)",
						'borderColor' => "rgba(237,184,38,1)",
						'pointBackgroundColor' => "rgba(237,184,38,1)",
						'pointBorderColor' => "#fff",
						'pointHoverBackgroundColor' => "#fff",
						'pointHoverBorderColor' => "rgba(237,184,38,1)",
						'data' => $jumlah_ugd,
					],
					
				]
			],
			
		]);
		?>	
	</div>
	<div class='col-md-6'>
		<?= ChartJs::widget([
			'type' => 'line',
			'options' => [
				'height' => 200,
				'width' => 400
				
			],
			'data' => [
				'labels' => $nama_ranap,
				'datasets' => [
					[
						
						'label' => "Grafik Income Ranap",
						'backgroundColor' => "rgba(90, 245, 66,0.8)",
						'borderColor' => "rgba(90, 245, 66,1)",
						'pointBackgroundColor' => "rgba(90, 245, 66,1)",
						'pointBorderColor' => "#fff",
						'pointHoverBackgroundColor' => "#fff",
						'pointHoverBorderColor' => "rgba(90, 245, 66,1)",
						'data' => $jumlah_ranap,
					],
					
				]
			],
			
		]);
		?>	
	</div>
</div>
</div>
</div>