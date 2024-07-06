<?php
use common\models\Poli;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\View;
?>
<div class='box'>
	<div class='box-body'>
	<div class='row'>
		<div class='col-md-3'>
			<div class='form-group'>
				<label> Vaksin Ke </label>
				<select id="pasien-poli" class="form-control" aria-invalid="false">
					<option value="">-Vaksin Ke-</option>
					<option value="1">Vaksin 1</option>
					<option value="2">Vaksin 2</option>
				</select>
				<br>
				<a id="show-all" class="btn btn-success" ><span class="fa fa-search" style="width: 20px;"></span>Cari</a>
			</div>
		</div>
		<div class='col-md-3'>
			<div class='form-group'>
				<label> Tanggal Vaksin </label>
				<input id='pasien-tgl' type='date' class='form-control'>
				<br>
			</div>
		</div>
	</div>
	<div class='row'>
			<div class='col-md-12'>				
				<div id='pasien-ajax'>	
				</div>
			</div>
		</div>

	</div>
</div>
<?php
$urlShowAll = Url::to(['vaksin/show']);
$this->registerJs("
	
	$('#show-all').on('click',function(){
	
			vaksin = $('#pasien-poli').val();
			tgl = $('#pasien-tgl').val();
			
			$.ajax({
				type: 'GET',
				url: '{$urlShowAll}',
				data: 'tgl='+tgl+'&vaksin='+vaksin,
				success: function (data) {

					
					$('#pasien-ajax').html(data);
					
					console.log(data);
					
				},
			});
		
	});


	
           
	

", View::POS_READY);
?>
