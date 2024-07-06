<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use yii\web\JsExpression;
use common\models\Obat;
use common\models\ApotekumumDetail;	
use yii\helpers\Url;
use yii\web\View;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Gagalfoto */
/* @var $form yii\widgets\ActiveForm */
	$formatJs = <<< 'JS'
var formatRepo = function (repo) {
    if (repo.loading) {
        return repo.text;
		
    }
    var marckup =repo.nama + ' ( '+ repo.stok +' ) ' +' - Rp.'+ repo.harga;   
    return marckup ;
};
var formatRepoSelection = function (repo) {
    return repo.nama || repo.text;
}
JS;
 
// Register the formatting script
$this->registerJs($formatJs, View::POS_HEAD);
 
// script to parse the results into the format expected by Select2
$resultsJs = <<< JS
function (data) {    
    return {
        results: data,
        
    };
}
JS;
$cresep = ApotekumumDetail::find()->where(['idtrx'=>$model->idtrx])->count();
$resepdetail = ApotekumumDetail::find()->where(['idtrx'=>$model->idtrx])->all();
$no = 1;
$json= Obat::find()->all();
$instArray = ArrayHelper::map($json,'id','namaobat','stok');
$harga_total = 0;
?>
<div class='container-fluid'>
	<div class='box box-warning box-header'>
		<h3>Tulis Resep</h3>
	</div>
	<?php if($model->status == 1){echo'';}else{ ?>
	<div class='box box-body'>
		<div class='row'>
			<div class='col-md-4'>
				<table class='table table-bordered'>
					<tr>
						<td>Nama Pasien</td>
						<td>:</td>
						<td><?= $model->nama ?></td>
					</tr>
					
					
				</table>
			
			</div>
			<div class='col-md-8'>
			<div class='box box-body'>
					 <?php $form = ActiveForm::begin(); ?>
					 <h3>Input Resep</h3><hr>
						<div class='row'>
						
							<div class='col-md-10'>
								<?= $form->field($resep, 'idobat')->widget(Select2::classname(), [
									'name' => 'kv-repo-template',
									'options' => ['placeholder' => 'Cari Obat .....'],
									'pluginOptions' => [
									'allowClear' => true,
									'minimumInputLength' => 3,
									'ajax' => [
									'url' => Yii::$app->params['baseUrl2'].'apites/list-obat',
									'dataType' => 'json',
									'delay' => 250,
									'data' => new JsExpression('function(params) { return {q:params.term};}'),
									'processResults' => new JsExpression($resultsJs),
									'cache' => true
									],
									'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
									'templateResult' => new JsExpression('formatRepo'),
									'templateSelection' => new JsExpression('formatRepoSelection'),
									],
								])->label('Obat');?>
							</div>
							<div class='col-md-2'>
								<?= $form->field($resep, 'qty')->textInput(['maxlength' => true,'required'=>true])->label('Qty') ?>
							</div>
							<div class='col-md-4'>
								<?= $form->field($resep, 'takaran')->textarea(['maxlength' => true,'rows'=>3])->label('Takaran') ?>
							</div>
							
							<div class='col-md-4'>
								<?= $form->field($resep, 'diminum')->textInput(['maxlength' => true,])->label('Diminum') ?>
							</div>
							<div class='col-md-4'>
								<?= $form->field($resep, 'khasiat')->textInput(['maxlength' => true,])->label('Khasiat') ?>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-4'>
								 <?= Html::submitButton( '+  Tambah', ['class' => 'btn btn-primary']) ?>
							</div>
						</div>
					 <?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
		
	</div>
	<?php } ?>
	<?php if($cresep == 0){echo'';}else{ ?>
	<div class='box box-warning box-header'>
		<h3>Obat</h3>
				<div class='box box-header'>
					<a href='<?= Yii::$app->params['baseUrl'].'/resep/label/'.$model->id?>'  class='btn btn-warning btn-xs'>Print</a>
					
				</div>
				<div class='box box-body'>
				<table class='table table-bordered'>
					<tr>
						<th>No</th>
						<th>Nama Obat</th>
						<th>Dosis</th>
						<th>Jumlah</th>
						<th>Harga</th>
			
						<th>Total</th>
						<th>#</th>
					</tr>
					<?php foreach($resepdetail as $rd): 
					
					$harga_total +=$rd->subtotal;
					?>
					<tr>
						<td><?= $no++?></td>
						<td><?= $rd->obat->namaobat?></td>
						<td><?= $rd->dosis?></td>
						<td align=center><?= $rd->qty ?> - <?= $rd->obat->satuan->satuan?></td>
						<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($rd->harga)?></td>
					
						<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($rd->subtotal)?></td>
						<?php if($model->status == 1){echo"<td><span class='label label-success'>Transaksi Selesai</span></td>";}else{ ?>
						<td><a href='<?= Yii::$app->params['baseUrl'].'/apotekumum/hapusobat/'.$rd->id?>' data-confirm="Are you sure ?" class='label label-danger'>-</td>
						<?php } ?>
					</tr>
					
					<?php endforeach; ?>
					<tr>
						<td align=right colspan="5"><b>Sub Total</b></td>
						<td align=right><b>Rp. <?= Yii::$app->algo->IndoCurr($harga_total)?></b></td>
						<td></td>
					</tr>
				</table>
				
	</div>
	<div class='box box-footer'>
		<a href='<?= Yii::$app->params['baseUrl'].'/apotekumum/selesai/'.$model->id?>'  class='btn btn-success btn-md'>Selesai</a>
	</div>
	</div>
	<?php } ?>
</div>