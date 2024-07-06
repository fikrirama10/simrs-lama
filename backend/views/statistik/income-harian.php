<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\web\View;
use common\models\Jenisbayar;
 $bayar = Jenisbayar::find()->where(['between','id',4,5])->all();
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

foreach($json_ugd as $ts){
	array_push($nama_ugd,$ts['hari']);
	array_push($jumlah_ugd,$ts['income']);
}

foreach($json_ranap as $tn){
	array_push($nama_ranap,$tn['hari']);
	array_push($jumlah_ranap,$tn['income']);
}
print_r($nama_rajal);
 ?>

<?php
			$start = (isset($_GET['start']))? $_GET['start'] : date('m');
			$end = (isset($_GET['end']))? $_GET['end'] : date('Y');
			$cek = (isset($_GET['cek']))? $_GET['cek'] : 'today';
			?>
<div class='box'>
<div class='box-header'>
	 	<div class='row'>
					<div class="col-sm-8">
					<div class="row">
						<div class="col-sm-6">						
							<label>Bulan</label>
							<select class="form-control" name="Bulan" id="start_date">
							  <option value="1">Januari</option>
							  <option value="2">Februari</option>
							  <option value="3">Maret</option>
							  <option value="4">April</option>
							  <option value="5">Mei</option>
							  <option value="6">Juni</option>
							  <option value="7">Juli</option>
							  <option value="8">Agustus</option>
							  <option value="9">September</option>
							  <option value="10">Oktober</option>
							  <option value="11">November</option>
							  <option value="12">Desember</option>
							</select>
						</div>
						<div class="col-sm-6">
							<label>Tahun</label>
							<?php
							$now=date('Y');
							echo "<select class='form-control' name='tahun' id='end_date'>";
							for ($a=2019;$a<=$now;$a++)
							{
								 echo "<option  value='$a'>$a</option>";
							}
							echo "</select>";
							?>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
				<div class='col-md-8'  style='margin-top:22px;'>
				<select  class="form-control" name='textsearch' id='textsearch' form='carform'>
									<option value=''>Pilih Jenis Transaksi</option>
									<?php foreach($bayar as $b ): ?>
									<option value="<?= $b->id ?>"><?= $b->jenisbayar ?></option>
									<?php endforeach; ?>
						</select>
				</div>
				<div class='col-md-1'  style='margin-top:22px;'><span class="input-group-btn">
							  <button type="button" class="btn btn-info btn-flat" id='btn-search'><i class='fa fa-search'></i></button>
				</span>	</div>
				
					
				</div>
				
</div>
</div>
<div class='box-body'>
<div id='ajax_gridview'>
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
				
                'label' => "Grafik Income Pasien Yanmasum",
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
</div>
</div>
<div class='box-footer'>
	<a href='<?= Url::to(['statistik/obat-harian-all']) ?>'>Lihat Selengkapnya >>> </a>
</div>
</div>


<?php
$urlDataSearch = Url::to(['statistik/get-income']);
$this->registerJs("

	$('input[value={$cek}]').attr('checked', true);
	if('{$cek}' == 'custom'){
		$('#start_date').attr('disabled', false);
		$('#end_date').attr('disabled', false);
	}else{
		$('#start_date').attr('disabled', false);
		$('#end_date').attr('disabled', false);
	}
	
	/*ini untuk mengeset end date ke button cek*/
	$('input[name=r2]').on('change',function(){
		var radio = $(this).val();
		var date = new Date();
		var day = date.getDate();
		var month = date.getMonth();
		var year = date.getFullYear();
		var lastday = new Date(year, month + 1, 0);
		var lastdayinyear = new Date(year, 12, 0);
		var nama_bulan= ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
		if(radio == 'today'){
			start = date.toLocaleFormat('%d-%b-%Y');
			end = date.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'this_month') {
			start = 1+'-'+nama_bulan[month]+'-'+year;
			end = lastday.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'this_year') {
			start = 1+'-'+nama_bulan[0]+'-'+year;
			end = lastdayinyear.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'custom') {
			start = $('#start_date').val();
			end = $('#end_date').val();
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom');
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek=custom');
			$('#start_date').attr('disabled', false);
			$('#end_date').attr('disabled', false);
		}
		
	});
	
	/*ini untuk mengeset start date ke button cek*/
	$('#start_date').on('change',function(){
		start = $(this).val();
		end = $('#end_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	/*ini untuk mengeset end date ke button cek*/
	$('#end_date').on('change',function(){
		end = $(this).val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	$('#btn-search').on('click', function(){
		end = $('#end_date').val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});
	
	function getSearch(start,end) {
		$.ajax({
			url: '{$urlDataSearch}'+'?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val(),
			type: 'GET',
			success: function(data){
				$('#ajax_gridview').html(data);
			}
		});
	}
	
", View::POS_READY);
?>
