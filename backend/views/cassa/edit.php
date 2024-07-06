
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Tindakan;
use yii\helpers\ArrayHelper;
use common\models\Resepdokter;
use kartik\select2\Select2;
use yii\web\View;
use yii\web\JsExpression;
use common\models\Rawatjalan;
use common\models\Lab;
use common\models\Tarif;
use common\models\Trandetail;
use common\models\Transaksi;
use yii\helpers\Url;
if($model->idbayar == 4){
	$url = "https://simrs.rsausulaiman.com/api/tarif-umum"	;
}else{
	$url = "https://simrs.rsausulaiman.com/api/tarif-bpjs"	;
}

$harga_total = 0;
$data = ArrayHelper::map(Tindakan::find()->all(), 'id', 'namatindakan','tarif');
$transd = Trandetail::find()->where(['idrawat'=>$model->id])->all();
$no=1;

$formatJs = <<< 'JS'
var formatRepo = function (repo) {
    if (repo.loading) {
        return repo.text;
		
    }
    var marckup = repo.tindakan + " ( Rp." + repo.tarif + " )";   
    return marckup ;
};
var formatRepoSelection = function (repo) {
    return repo.tindakan || repo.text;
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
?>

<div class='box'>
	<div class='box box-body'>
		<div class='box box-header'><h3>Data Bayar Pasien</h3></div>
		<div class='container-fluid'>
			<div class='row'>
				<div class='col-md-4'>
					<div class='form-group'>
						<input type='text' class='form-control' value='<?= $model->no_rekmed?>' readonly>
						<input type='text' class='form-control' value='<?= $model->pasien->sbb?>.<?= $model->pasien->nama_pasien?>' readonly>
						<input type='text' class='form-control' value='<?= $model->carabayar->jenisbayar?>' readonly>
						<input type='text' class='form-control' value='<?= $model->tgldaftar?>' readonly>
					</div>
				</div>
				<div class='col-md-8'>
				
					 <?php $form = ActiveForm::begin(); ?>
				
					 <div class='row'>
						<div class='col-md-8'>
						<?= $form->field($trx, 'idtindakan')->widget(Select2::classname(), [
					'name' => 'kv-repo-template',
					'options' => ['placeholder' => 'Cari Tindakan .....'],
					'pluginOptions' => [
					'allowClear' => true,
					'minimumInputLength' => 3,
					'ajax' => [
					'url' => $url,
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
				])->label("Tindakan");?>
						</div>
						<div class='col-md-2'> <?= $form->field($trx, 'jumlah')->label("Jumlah "); ?></div>
						<div class='col-md-1'>
						 <label><br></label>
							<?= Html::submitButton('+', ['class' => 'btn btn-primary']) ?>
						
						</div>
					</div>
					 <?php ActiveForm::end(); ?>
				
				</div>
			</div>
		</div>
	</div>
	<div class='box box-body'>
		<div class='container-fluid'>
		<table class='table table-bordered'>
			<tr>
				<th>No</th>
				<th>Tindakan</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Total</th>
				<th>#</th>
			</tr>
			<?php foreach($transd as $td): ?>
			<tr>
				<td><?= $no++?></td>
				<?php $rr = Tarif::find()->where(['id'=>$td->idtindakan])->count(); ?>
				<?php if($rr == 0){ ?>
				<td><?= $td->idtindakan ?></td>
				<?php }else{?>
				<td><?= $td->tindakan->nama ?></td>
				<?php }?>
				<td><?= $td->jumlah ?> Kali</td>
				<td>Rp. <?= $td->harga ?></td>
				<td>Rp. <?= $td->harga * $td->jumlah ?></td>			
				<td><a href='<?= Url::to(['cassa/deletetind/'.$td->id]) ?>'><span class="label label-danger"><i class="fa fa-close"></i></span></a></td>				
			</tr>
			<?php endforeach; ?>
		</table>
		<?php if($model->sbayar == 1){ ?>
			<a href='<?= Url::to(['cassa/beres/'.$tra->id])?>' class="btn btn-primary pull-right">Selesai</a>	 
		<?php }else{  ?>
			<a href='<?= Url::to(['cassa/selesai/'.$model->id])?>' class="btn btn-primary pull-right">Bayar</a>	
		<?php } ?>
		</div>
	</div>
</div>