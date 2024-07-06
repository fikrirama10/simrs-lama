
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
use common\models\Trandetail;
use common\models\Transaksi;
use common\models\Tarif;
use yii\helpers\Url;
if($model->idbayar == 4){
	$url = "https://simrs.rsausulaiman.com/api/tarif-umum"	;
}else{
	$url = "https://simrs.rsausulaiman.com/api/tarif-bpjs"	;
}

$harga_total = 0;
$data = ArrayHelper::map(Tindakan::find()->all(), 'id', 'namatindakan','tarif');
$transd = Trandetail::find()->where(['idtrx'=>$model->idtrx])->all();
$rawatjalan = Rawatjalan::find()->where(['id'=>$model->idrawat])->one();
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
		<div class='box box-header'><h3>Data Bayar Pasien</h3></div>
	<div class='box box-body'>

			<table class='table table-bordered'>
			<tr>
				<th width=200>Nama Pasien</th>
				<td width=10>:</td>
				<td><?= $rawatjalan->pasien->sbb?>.<?= $rawatjalan->pasien->nama_pasien?></td>
			</tr>
			<tr>
				<th width=200>No RM</th>
				<td width=10>:</td>
				<td><?= $rawatjalan->no_rekmed?></td>
			</tr>
			<tr>
				<th width=200>Id Rawat</th>
				<td width=10>:</td>
				<td><?= $rawatjalan->idrawat?></td>
			</tr>
			<tr>
				<th width=200>Jenis Rawat</th>
				<td width=10>:</td>
				<td><?= $rawatjalan->jerawat->jenisrawat?></td>
			</tr>
			<tr>
				<th width=200>Cara Bayar</th>
				<td width=10>:</td>
				<td><?= $rawatjalan->carabayar->jenisbayar?></td>
			</tr>
			<tr>
				<th width=200>Tanggal Register</th>
				<td width=10>:</td>
				<td><?= date('Y / m / d',strtotime($rawatjalan->tgldaftar))?></td>
			</tr>
			<?php if($rawatjalan->idjenisrawat == 1){?>
			<tr>
				<th width=200>Cara Bayar</th>
				<td width=10>:</td>
				<td><?= $rawatjalan->polii->namapoli?></td>
			</tr>
			<?php }else if($rawatjalan->idjenisrawat == 2){ ?> 
			<tr>
				<th width=200>Kelas Rawat</th>
				<td width=10>:</td>
				<td><?= $rawatjalan->kelas->namakelas?></td>
			</tr>
			<tr>
				<th width=200>Tanggal Masuk</th>
				<td width=10>:</td>
				<td><?= date('Y / m / d',strtotime($rawatjalan->tglmasuk))?></td>
			</tr>
			<?php }else{ ?>
			
			<?php }?>
			<tr>
				<th width=200>Kode Dokter</th>
				<td width=10>:</td>
				<td></td>
			</tr>
			<tr>
				<th width=200>Transaksi Id</th>
				<td width=10>:</td>
				<td><?= $model->idtrx ?></td>
			</tr>
		</table>
		<hr>
		<?php if($rawatjalan->sbayar > 0){ ?>
		<?php if(Yii::$app->user->identity->pegawai->unit == 1){ ?>
		<a href='<?= Url::to(['billing/edit?id='.$model->id])?>' class="btn bg-maroon pull-left">Edit</a> 
		<a href='<?= Url::to(['billing/edit-dokter?id='.$model->id])?>' class="btn bg-navy pull-left">Edit Dokter</a> 
		<a href='<?= Url::to(['billing/cek-obat?id='.$rawatjalan->id])?>' class="btn btn-success pull-left">Cek Obat</a>
		<?php } ?>
		<?php }else{ ?>
		<a href='<?= Url::to(['billing/cek-obat?id='.$rawatjalan->id])?>' class="btn btn-success pull-left">Cek Obat</a>
		<?php } ?>
		
	</div>
	<div class='box box-body'>
	<?php if($rawatjalan->sbayar > 0){ ?>
	<?php }else{ ?>
	<div class='row'>
				<div class='col-md-8'>

					 <?php $form = ActiveForm::begin(); ?>
				
					 <div class='row'>
						<div class='col-md-8'>
					<?= $form->field($trx, 'idtindakan')->widget(Select2::classname(), [
					'name' => 'kv-repo-template',
					'options' => ['placeholder' => 'Cari Tindakan .....','required'=>true],
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
						<div class='col-md-2'> <?= $form->field($trx, 'jumlah')->textInput(['required' => true])->label('Jumlah') ?></div>
						<div class='col-md-1'>
						 <label><br></label>
							<?= Html::submitButton('+', ['class' => 'btn btn-primary']) ?>
						
						</div>
					</div>
					 <?php ActiveForm::end(); ?>
						
			
				</div>
			</div>
	<?php } ?>
		<table class='table table-bordered'>
			<tr>
				<th>No</th>
				<th>Tindakan</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Total</th>
				<th>#</th>
			</tr>
			<?php foreach($transd as $td): 
			$harga_total +=$td->total;
			?>
			<tr>
				<td><?= $no++?></td>
				<td><?php $tarif= Tarif::findOne($td->idtindakan); if($tarif){echo $tarif->nama;}else{echo'Administrasi Pasien';} ?></td>
				<td><?= $td->jumlah ?> Kali</td>
				<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($td->harga)?></td>
				<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($td->total)?></td>
					<?php if($rawatjalan->sbayar > 0){echo'<td></td>';}else{ ?>
					<td><a href='<?= Url::to(['cassa/deletetind/'.$td->id]) ?>'><span class="label label-danger"><i class="fa fa-close"></i></span></a></td>
					<?php } ?>
				
			</tr>
			
			
			<?php endforeach; ?>
			<tr>
				<td align=right colspan="4"><b>Sub Total</b></td>
				<td align=right><b>Rp. <?= Yii::$app->algo->IndoCurr($harga_total)?></b></td>
				<td></td>
			</tr>
		</table>
		<hr>
			<?php if($rawatjalan->sbayar == 1){ ?>
			<?php if($model->status == 2){ ?>
				<a href='<?= Url::to(['/billing'])?>' class="btn btn-primary pull-right">Selesai</a>	
			<a id="confirm" href='<?= Url::to(['cassa/print/'.$model->id])?>' target="_blank" class="btn btn-danger">Print</a>
			<?php if(Yii::$app->user->identity->idpriv == 6){ ?>
		    	<a href='<?= Url::to(['cassa/print-faktur?id='.$model->id])?>' target="_blank" class="btn btn-danger">Print Obat</a>
			<?php } ?>
			<?php }else{ ?>
		<a href='<?= Url::to(['/billing'])?>' class="btn btn-primary pull-right">Selesai</a>	
			<?php if(Yii::$app->user->identity->idpriv == 6){ ?>
			<a href='<?= Url::to(['cassa/print-faktur?id='.$model->id])?>' target="_blank" class="btn btn-danger">Print Obat</a>
			<?php } ?>
			<a href='<?= Url::to(['cassa/print/'.$model->id])?>' target="_blank" class="btn btn-warning">Print</a>
			<?php } ?>			
		<?php }else{  ?>
			<a href='<?= Url::to(['billing/selesai/'.$model->id])?>' class="btn btn-primary pull-right">Bayar</a>	
			
		<?php } ?>
		
			
		
		
		
	</div>
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