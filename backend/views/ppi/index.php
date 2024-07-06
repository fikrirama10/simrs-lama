<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\date\DatePicker;
use common\models\Ppi;
use common\models\Pasien;
use common\models\Rawatjalan;
use yii\web\View;
/* @var $searchModel common\models\PpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kepatuhan Cuci Tangan';
$this->params['breadcrumbs'][] = $this->title;
$ppi = Ppi::find()->all();
$model = new Ppi() ;
$mount[] = ['1'=>'January','2'=>'February','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni','7'=>'July','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];

// $cppi = Ppi::find()->select(['ppi.*', 'SUM(total) AS jumlah','DATE_FORMAT(tanggal,"%Y-%m-%d") AS tanggal'])
	   // ->groupBy('DATE_FORMAT(tanggal,"%Y-%m-%d")')->all();
$cppi = Ppi::find()->select(['ppi.*', 'SUM(total) AS jumlah','DATE_FORMAT(tanggal,"%Y-%m-%d") AS tanggal'])->groupBy(['DATE_FORMAT(tanggal,"%Y-%m-%d")'])->all();
// echo date('d F Y',strtotime("+7 day"));
	
	
	$i = 0;
	$j = 0;
	$color = ['#fb954f','#6faab0','#c4c24a','#f6b53f','#e94649', '#48aa9f'];
	
	if(count($bybulan) < 1){
		$bulan[] = [date('M')];
		
		if(count($rawat) < 1){
			$data[] = ['name' => 'perawatan', 'data' => [0], ];
		}else{
			foreach($rawat as $cb):
			
				$j++;
				$data[] = ['name' => $cb->tanggal, 'data' => [0], ];
			
			endforeach;
		}
	}else{
		$awal = date('W', mktime(0, 0, 0, date('m'), 1, date('Y')));
		$week = array();
		foreach($bybulan as $bl):
			$week = $bl->tanggal - $awal + 1;
			$bulan[] = 'Minggu Ke-'. $week;
		endforeach;
		foreach($rawat as $cb):
			$bybulan = $bybulan2;
			$i++;
			foreach($bybulan as $tr):
				$arraytr[$i][] = (int) $tr->jumlah * 2 / $tr->Cnt;
			endforeach;
			endforeach;
			

			$j++;
			$data[] = ['name'=>'jumlah Pasien','data' => $arraytr[$j], ];
	
	
	}
	

	?>
<div class="ppi-index">

		<?php
			$start = (isset($_GET['start']))? $_GET['start'] : date('d-M-Y');
			$end = (isset($_GET['end']))? $_GET['end'] : date('d-M-Y');
			$cek = (isset($_GET['cek']))? $_GET['cek'] : 'today';
			?>
				<!--div class="col-sm-4">
				  <div class="form-group mup25">
					<label class="mright10">
					  <input type="radio" value="today" name="r2" class="minimal-red" checked>
					  Today
					</label>
					<label class="mright10">
					  <input type="radio" value="this_month" name="r2" class="minimal-red">
					  This Month
					</label>
					<label class="mright10">
					  <input type="radio" value="this_year" name="r2" class="minimal-red">
					  This Year
					</label class="mright10">
					<label>
					  <input type="radio" value="custom" name="r2" class="minimal-red">
					  Custom
					</label>
				  </div>
				</div-->
				
    	<div class='box box-body table-responsive'>
		<div class='row'>
		<div class="col-sm-5">
					<div class="row">
						<div class="col-sm-6">
							<label>Start Date</label>
							<?= DatePicker::widget([
							'id' => 'start_date',
							'name' => 'start_date',
							'value' => $start,
							'options' => ['placeholder' => 'Select issue date ...'],
							'removeButton' => false,
							'pluginOptions' => [
								'format' => 'dd-M-yyyy',
								'todayHighlight' => true
							]
							]); ?>
						</div>
						<div class="col-sm-6">
							<label>End Date</label>
							<?= DatePicker::widget([
							'id' => 'end_date',
							'name' => 'end_date',
							'value' => $end,
							'options' => ['placeholder' => 'Select issue date ...'],
							'removeButton' => false,
							'pluginOptions' => [
								'format' => 'dd-M-yyyy',
								'todayHighlight' => true
							]
							]); ?>
						</div>
					</div>
				</div>
				
		</div>	
<br>		
        <?= Html::a('Create PPI', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    <hr>	
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tanggal;
						},
					],
					[
						'attribute' => 'IPCLN',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->ipc->nama;
						},
					],
					[
						'attribute' => 'Unit',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->uni->unit;
						},
					],
					[
						'attribute' => 'Person',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->person;
						},
					],
					[
						'attribute' => 'Momen 1 ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->momen1 == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Momen 2 ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->momen2 == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Momen 3 ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->momen3 == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Momen 4 ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->momen4 == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Momen 5 ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->momen5 == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Kepatuhan ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$cuci = $model->momen1 + $model->momen2 + $model->momen3 + $model->momen4 + $model->momen5 ;
							$hitung = $cuci/5*10;
							return $hitung.'';
							},
					],
					
					
					[
						'attribute' => 'Ket',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$cuci = $model->momen1 + $model->momen2 + $model->momen3 + $model->momen4 + $model->momen5 ;
							$hitung = $cuci/5*10;
							if($hitung < 10){								
								return '<span class="label label-danger">Tidak Patuh</span>';
							}else{
								return '<span class="label label-success">Patuh</span>';
							}
						},
					],
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{update}',
						'buttons' => [
						
															
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-pencil"></span></span>', 
												$url);
								},
																
								
								
							],
					],
					
	
					
				],
			]); ?>
			

	
		</div>
</div>


<?php
$urlDataSearch = Url::to(['ppi/get-search']);
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
