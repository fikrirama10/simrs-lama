<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\web\View;
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
<?php
			$start = (isset($_GET['start']))? $_GET['start'] : date('m');
			$end = (isset($_GET['end']))? $_GET['end'] : date('Y');
			$cek = (isset($_GET['cek']))? $_GET['cek'] : 'today';
			?>
<div class='box box-header'>
	 	<div class='row'>
					<div class="col-sm-8">
					<div class="row">
						<div class="col-sm-6">
							<label>Tahun</label>
							<?php
							$now=date('Y');
							echo "<select class='form-control' name='tahun' id='start_date'>";
							for ($a=2019;$a<=$now;$a++)
							{
								 echo "<option  value='$a'>$a</option>";
							}
							echo "</select>";
							?>
						</div>
						<div class='col-md-1'  style='margin-top:22px;'><span class="input-group-btn">
							  <button type="button" class="btn btn-info btn-flat" id='btn-search'><i class='fa fa-search'></i></button>
				</span>	</div>
					</div>
				</div>
				<div class="col-sm-3">
				
				
				
					
				</div>
				
</div>
</div>
<div class='box box-body'>
<div id='ajax_gridview'>
<h3>Grafik Data Pendapatan Pasien  <?= $title ?> </h3>
<a href='<?= Url::to(['statistik/income-harian']) ?>'>Detail Grafik Harian</a>
<div class="col-md-12">

<?= ChartJs::widget([
    'type' => 'line',
    
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
	'options' => [
    'responsive' => true,
    'scales' => [
         'xAxes' => [[
              'gridLines' => [
                   'display' => false,
                   'color' => '#ffffff'
              ],
              'ticks' => [
                  'fontColor' => "#fff",
              ],
              'scaleLabel' => [
                   'display' => true,
                   'labelString' => 'Teilnahmen',
                   'fontColor' => '#fff',
              ],
         ]],
    ],
	]
]);
?>
</div>
</div>
</div>

<?php
$urlDataSearch = Url::to(['statistik/get-income-bulanan']);
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

