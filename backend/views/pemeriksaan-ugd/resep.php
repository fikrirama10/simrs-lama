<?php
use common\models\PemeriksaanUgddiagsekunder;
use common\models\PemeriksaanUgdResep;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\View;
use yii\web\JsExpression;
$no=1;
$obat = PemeriksaanUgdResep::find()->where(['idpemeriksaan'=>$model->id])->all();
if($model->rawat->idbayar == 4){
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
    var marckup =repo.nama + ' ( '+ repo.stok +' ) ' ;   
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
/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanUgddiagsekunder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemeriksaan-ugddiagsekunder-form">
	<div class='box box-header'>
		<h2>Input Resep</h2>
	</div>
	<div class='box box-body'>
	 <h3><?= Html::encode($this->title) ?></h3>
	<div class='row'>
		<div class='col-md-6'>
			 <?php $form = ActiveForm::begin(); ?>
				
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
				<?= $form->field($resep, 'jumlah')->textInput(['maxlength' => true,'required'=>true])->label('jumlah') ?>
				<?= $form->field($resep, 'dosis')->textInput(['maxlength' => true,'rows'=>3])->label('dosis') ?>
				<div class="form-group">
					<?= Html::submitButton('+', ['class' => 'btn btn-success']) ?>
				</div>
				
				<?php ActiveForm::end(); ?>
				
				<?php if($obat > 0){ ?>
					<table class='table table-bordered' >
						<tr>
							<th>No</th>
							<th>Obat</th>
							<th>Dosis</th>
							<th>Delete</th>
						</tr>
						<?php foreach($obat as $ob):?>
						<tr>
							<td><?= $no++?></td>
							<td><?= $ob->obat->namaobat ?> ( <?= $ob->jumlah ?> <?= $ob->obat->satuan->satuan ?> )</td>
							<td><?= $ob->dosis ?></td>
							<td><a href='<?= Url::to(['pemeriksaan-ugd/delete-resep?id='.$ob->id]) ?>'><span class="label label-danger"><i class="fa fa-trash"></i></span></a></td>
						</tr>
						<?php endforeach; ?>
						
					</table>
				<?php }?>
		</div>
		<di class='col-md-6'>
		    	<div class="alert alert-info" role="alert">
					<h3>Petunjuk </h3>
					<p>Jika sudah selesai Tutup halaman untuk kembali ke halaman sebelumnya</p>
					
					<br>
				</div>
		    
		</div>
	</div>
   
	</div>
</div>
