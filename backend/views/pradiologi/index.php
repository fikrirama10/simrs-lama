<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\Pasien;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PradiologiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Indikator Klinis 3 Pasien Igd (Pelayanan Radiologi)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pradiologi-index">
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
<div class='box box-body table-responsive' style='margin-top:20px;'>
		  <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a(' + ', ['create'], ['class' => 'btn btn-success']) ?>
    	
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>true,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('d F Y',strtotime($model->tanggal));
						},
					],
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->pasien->nama_pasien;
							}
							
						},
					],
					[
						'attribute' => 'Usia',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->pasien->usia;
							}
						},
					],
					[
						'attribute' => 'no rm',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rekmed;
						},
					],
					[
						'attribute' => 'Jam Diambil ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return $model->jamdiambil;
						},
					],
					[
						'attribute' => 'Jam Hasil',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return $model->jamhasil;
						},
					],
					[
						'attribute' => 'Durasi (menit) ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return $model->durasi.' menit';
						},
					],
					[
						'attribute' => 'Standar',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return '< 60 menit';
						},
					],
					[
						'attribute' => 'Ket',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->durasi < 60){
								return '<span class="label label-success">Memenuhi</span>';
							}else{
								return '<span class="label label-danger">Tidak Memenuhi</span>';
							}
						},
					],
					[
						'attribute' => 'Jenis Pemeriksaan ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->periksa->jenispemeriksaan;
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
$urlDataSearch = Url::to(['pradiologi/get-search']);
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
