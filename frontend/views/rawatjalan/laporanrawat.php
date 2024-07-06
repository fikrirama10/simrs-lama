<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\View;
use kartik\grid\GridView;
use dosamigos\chartjs\ChartJs;
use kartik\date\DatePicker;
use common\models\Jenisrawat;
use common\models\Poli;
use common\models\Rawatjalan;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TransaksiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$jrawat = Jenisrawat::find()->all();
$this->title = 'Laporan Rawat '. $title;
$this->params['breadcrumbs'][] = $this->title;
$jenisrawat = Poli::find()->all();
	$rawat = Rawatjalan::find()->joinWith(['polii as pol'])->where(['idjenisrawat'=>'1'])->groupBy(['pol.namapoli'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
	$bybulan = Rawatjalan::find()->where(['idjenisrawat'=>'1'])->joinWith(['jerawat as jenis'])->groupBy(['DATE_FORMAT(tgldaftar, "%M")','DATE_FORMAT(tgldaftar, "%Y")'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
	
	$i = 0;
	$j = 0;
	$color = ['#fb954f','#6faab0','#c4c24a','#f6b53f','#e94649', '#48aa9f'];
	
	if(count($bybulan) < 1){
		$bulan[] = [date('M')];
		
		if(count($jenisrawat) < 1){
			$data[] = ['name' => 'poli', 'data' => [0], ];
		}else{
			foreach($jenisrawat as $cb):
				$j++;
				$data[] = ['name' => $cb->namapoli, 'data' => [0], ];
			endforeach;
		}
	}else{
		foreach($bybulan as $bl):
			$bulan[] = date('F',strtotime($bl->tgldaftar));
		endforeach;
		
		foreach($rawat as $cb):
			$bybulan = Rawatjalan::find()->select(['DATE_FORMAT(tgldaftar, "%M")', 'COUNT(idrawat) as Cnt'])->where(['idpoli'=>$cb->idpoli])->andwhere(['idjenisrawat'=>'1'])->groupBy(['DATE_FORMAT(tgldaftar, "%M")','DATE_FORMAT(tgldaftar, "%Y")'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
			$i++;
			foreach($bybulan as $tr):
				$arraytr[$i][] = (int) $tr->Cnt;
			endforeach;
		endforeach;
		
		foreach($rawat as $cb):
			$j++;
			$data[] = ['name' => $cb->polii->namapoli, 'data' => $arraytr[$j], ];
		endforeach;
	}
?>
<div class="transaksi-index" style='margin-top:20px;'>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="box">
		<div class="box-header">
			<h3>Data Pasien Rawat</h3>
			<div class="row">
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
				<div class="col-sm-3">
				<div class='col-md-8'  style='margin-top:22px;'>
				<select  class="form-control" name='textsearch' id='textsearch' form='carform'>
									<option value=''>Pilih Rawat</option>
									<?php foreach($jrawat as $b ): ?>
									<option value="<?= $b->id ?>"><?= $b->jenisrawat ?></option>
									<?php endforeach; ?>
						</select>
				</div>
				<div class='col-md-4'  style='margin-top:22px;'>	<span class="input-group-btn">
							  <button type="button" class="btn btn-info btn-flat" id='btn-search'><i class='fa fa-search'></i></button>
				</span>	</div>
				
					
				</div>
				
				<div class="col-sm-3">
					<a href="laporanrawat?start=<?= $start ?>&end=<?= $end ?>&cek=<?= $cek ?>" id="cek" class="btn btn-warning mup25" style="display:none;">Apply Filter</a>
					  <!-- radio -->
					<a href="report?start=<?= $start ?>&end=<?= $end ?>&cek=<?= $cek ?>" target="blank" id="print_pdf" class="btn btn-danger" style='margin-top:22px;'><i class="fa fa-print" style="width:20px"></i>Print Pdf</a>
				</div>
			</div>
		</div>
		
		<div class="box-body table-responsive">
		<?php Pjax::begin(); ?>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'showPageSummary'=>true,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rekmed;
						},
					],
					[
						'attribute' => 'No rawat ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
								return Html::a($model->idrawat, Url::to(['previewpasien/'.$model->id]));
						},
					],
					[
						'attribute' => 'Nama Pasien ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nama_pasien;
						},
					],
					
					
					
					[
						'attribute' => 'Tanggal Daftar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tgldaftar;
						},
					],
					[
						'attribute' => 'Jenis Rawat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jerawat->jenisrawat;
						},
					],
					
					
					
					
				],
			]); ?>
			<?php Pjax::end(); ?>
					<div class="col-sm-12">
			
				<!--h3>STATISTIK PENJUALAN</h3-->
		<?= \dosamigos\highcharts\HighCharts::widget([
		'clientOptions' => [
			'chart' => [
				'type' => 'bar'
			],
			'title'=> [
				'text'=> 'STATISTIK Rawat Jalan',
				'x'=> -30 //center
			],
			'subtitle'=> [
				'text'=> '',
				'x'=> -20
			],
			'xAxis'=> [
				'categories'=> $bulan
			],
			'yAxis'=> [
				'title'=> [
					'text'=> 'Jumlah Pasien Daftar Rawat Jalan'
				],
				'plotLines'=> [[
					'value'=> 0,
					'width'=> 1,
					'color'=> '#808080'
				]]
			],
			'tooltip'=> [
				'valueSuffix'=> ''
			],
				
			'legend'=> [
				'layout'=> 'vertical',
				'align'=> 'right',
				'verticalAlign'=> 'middle',
				'borderWidth'=> 0
			],
			'series' => $data
		]
	]);
	?>
			
		</div>
		</div>
	</div>
	
</div>

<?php
$urlDataSearch = Url::to(['rawatjalan/get-search']);
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