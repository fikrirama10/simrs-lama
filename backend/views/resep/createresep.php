	<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use yii\web\JsExpression;
use common\models\Obat;
use common\models\Trxresep;	
use yii\helpers\Url;
use yii\web\View;
use kartik\date\DatePicker;
if($rawat->idbayar == 4){
	$url = "https://simrs.rsausulaiman.com/apites/list-obat-umum"	;
}else{
	$url = "https://simrs.rsausulaiman.com/apites/list-obat-bpjs"	;
}
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
$cresep = Trxresep::find()->where(['trxid'=>$model->idtrx])->count();
$resepdetail = Trxresep::find()->where(['trxid'=>$model->idtrx])->all();
$no = 1;
$json= Obat::find()->all();
$instArray = ArrayHelper::map($json,'id','namaobat','stok');
$harga_total = 0;
$hari = date('Y-m-d',strtotime($model->tglresep));
?>
<div class='container-fluid'>
	<div class='box box-warning box-header'>
		<h3>Tulis Resep</h3>
	</div>
	<div class='box box-body'>
		<div class='row'>
			<div class='col-md-4'>
				<table class='table table-bordered'>
					<tr>
						<td>Nama Pasien</td>
						<td>:</td>
						<td><?= $rawat->pasien->nama_pasien?></td>
					</tr>
					<tr>
						<td>No RM</td>
						<td>:</td>
						<td><?= $rawat->no_rekmed?></td>
					</tr>
					<tr>
						<td>Usia</td>
						<td>:</td>
						<td><?= $rawat->usia?> th</td>
					</tr>
					<tr>
						<td>Jenis Rawat</td>
						<td>:</td>
						<td><?= $rawat->jerawat->jenisrawat?></td>
					</tr>
					<tr>
						<td>Jenis Bayar</td>
						<td>:</td>
						<td><?= $rawat->carabayar->jenisbayar?></td>
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
					'url' =>$url,
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
								<?= $form->field($resep, 'jumlah')->textInput(['maxlength' => true])->label('Qty') ?>
							</div>
							<div class='col-md-4'>
								<?= $form->field($resep, 'dosis')->textInput(['maxlength' => true,'rows'=>3])->label('dosis') ?>
							</div>	
							<div class='col-md-4'>
								<?= $form->field($resep, 'takaran')->dropDownList([ 'tablet' => 'tablet', 'kapsul' => 'kapsul', 'bungkus' => 'bungkus', 'tetes' => 'tetes', 'ml' => 'ml' ,'sendok takar 5ml' => 'sendok takar 5ml','sendok takar 15ml' => 'sendok takar 15ml', ])->label('Takaran') ?>
							</div>							
							<div class='col-md-4'>
								<?= $form->field($resep, 'diminum')->dropDownList([ 'Sebelum Makan' => 'Sebelum Makan', 'Sesudah Makan' => 'Sesudah Makan', ])->label('Diminum') ?>
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
	<?php if($cresep == 0){echo'';}else{ ?>
	<div class='box box-warning box-header'>
		<h3>Obat</h3>
				<div class='box box-header'>
					<a href='<?= Yii::$app->params['baseUrl'].'/dashboard/resep/label/'.$model->id?>'  class='btn btn-warning btn-xs'>Print</a>
					<a target='_blank' href='<?= Yii::$app->params['baseUrl'].'/dashboard/resep/faktur?id='.$model->id?>'  class='btn bg-navy btn-xs'>Print Faktur</a>
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
						<th>Hapus</th>
						<th>Return</th>
					</tr>
					<?php foreach($resepdetail as $rd): 
					$bat = Obat::find()->where(['id'=>$rd->idobat])->count();
					$harga_total +=$rd->total;
					?>
					<tr>
						<td><?= $no++?></td>
						<?php if($bat < 1){ ?>
						    <td><?= $rd->idobat?></td>
						<?php }else{ ?>
						    <td><?= $rd->obat->namaobat?></td>
						<?php } ?>
						<td><?= $rd->dosis?></td>
						<td align=center><?= $rd->jumlah ?> - <?= $rd->obat->satuan->satuan ?></td>
						<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($rd->harga)?></td>
					
						<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($rd->total)?></td>
					
						<td><a href='<?= Yii::$app->params['baseUrl'].'/dashboard/resep/hapusobat/'.$rd->id?>' data-confirm="Are you sure ?" class='btn btn-danger'><i class='fa fa-trash'></i></a></td>
						<td><a id='confirm' href='<?= Yii::$app->params['baseUrl'].'/dashboard/resep/retur?id='.$rd->id.'&obat='.$rd->idobat?>' class='btn btn-warning'><i class='fa fa-mail-reply'></i></a></td>
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
		<a href='<?= Yii::$app->params['baseUrl'].'/dashboard/resep/selesai/'.$model->id?>'  class='btn btn-success btn-md'>Selesai</a>
	</div>
	</div>
	<?php } ?>
</div>
<?php 
$this->registerJs("

$('#confirm').on('click', function(event){
	age =  prompt('Masukan Kode Verifikasi?', );
	if(age == '3321'){
       return true;
    } else {
        event.preventDefault();
        return false;
    }
});

", View::POS_READY);
?>