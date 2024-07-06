<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\PermintaanBarangDetail;
use yii\helpers\Url;
use yii\web\View;
if($model->jenis == 4){
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
    var marckup =repo.nama + ' ( '+ repo.stok +'  '+ repo.satuan +' ) ' +' - Rp.'+ repo.harga + ' <b> (' + repo.kadaluarsa +')</b> ';   
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


$up = PermintaanBarangDetail::find()->where(['idtrx'=>$model->id])->andwhere(['<>','status',12])->all();
$uptambahan = PermintaanBarangDetail::find()->where(['idtrx'=>$model->id])->andwhere(['status'=>12])->all();
$no = 1;

?>
<div class='box box-body'>
	<h3>Tambah Item</h3>
	<hr>
	<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($detail, 'idobat')->widget(Select2::classname(), [
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
	<?= $form->field($detail, 'qty')->textInput(['maxlength' => true]) ?>
	<?= $form->field($detail, 'keterangan')->textInput(['maxlength' => true]) ?>
	<?= Html::submitButton('Tambah',['class' => 'btn btn-success']) ?>
	<?php ActiveForm::end(); ?>
	<hr>
	<table class='table table-bordered'>
		<tr>
			<td width=200>Nomer Permintaan</td>
			<td width=10>:</td>
			<td><?= $model->idpermintaan ?></td>
		</tr>
		<tr>
			<td>Tanggal Permintaan</td>
			<td>:</td>
			<td><?= $model->tanggal ?></td>
		</tr>
		<tr>
			<td>Total Permintaan</td>
			<td>:</td>
			<td>Rp. <?= Yii::$app->algo->IndoCurr($model->total) ?></td>
		</tr>
	</table>
	<hr>
	<h4>Daftar Barang Tambahan</h4>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Obat</th>
				<th>Jumlah</th>
				<th>Harga Satuan</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($uptambahan as $upt): ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $upt->namaobat ?></td>
				<td><?= $upt->qty?> <?= $upt->obat->satuan->satuan?></td>
				<td>Rp. <?= Yii::$app->algo->IndoCurr($upt->harga)?></td>
				<td>Rp. <?= Yii::$app->algo->IndoCurr($upt->harga)?></td>
				<td><a href='<?= Url::to(['permintaan-barang/delete-item?id='.$upt->id]) ?>'><span class="label label-danger">delete</span></a></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<hr>
	<h4>Daftar Barang</h4>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Obat</th>
				<th>Jumlah</th>
				<th>Harga Satuan</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($up as $up): ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $up->namaobat ?></td>
				<td><?= $up->qty?> <?= $up->obat->satuan->satuan?></td>
				<td>Rp. <?= Yii::$app->algo->IndoCurr($up->harga)?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<hr>
	<a  href='<?= Url::to(['permintaan-barang/view?id='.$model->id]) ?>' class='btn btn-primary '>Kembali</a>
</div>
