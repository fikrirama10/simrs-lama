<?php

use kartik\date\DatePicker;
use yii\widgets\DetailView;
use mdm\widgets\TabularInput;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PermintaanBarangDetail;
use yii\helpers\Url;
$up = PermintaanBarangDetail::find()->where(['idtrx'=>$model->id])->all();
$no = 1;
/* @var $this yii\web\View */
/* @var $model common\models\PermintaanBarang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Permintaan Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permintaan-barang-view">
<?php if($model->status == 1){ ?>
<?php $form = ActiveForm::begin(); ?>
<div class='box box-body'>       
	<h4>Pengajuan Obat / Alkes <?= $model->bayar->jenisbayar ?></h4>
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
	   <div class="row">
                <div class="col-lg-6">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th class="col-lg-3">Nama</th>
                        <th class="col-lg-3">Jumlah</th>
                        <th class="col-lg-3">Minimal Stok</th>
                        <th class="col-lg-3">Sisa Stok</th>
                        </tr>
                        </thead>
                        <?=
                          TabularInput::widget([
                            'id' => 'detail-grid',
                            'model' => \common\models\PermintaanBarangDetail::className(),  // <---- ini
                            'allModels' => $aNilai,  // <---- dan ini
                            'options' => ['tag' => 'tbody'],
                            'itemOptions' => ['tag' => 'tr'],
                            'itemView' => '_item_detail',
                        ])
                        ?>
                    </table>
                </div>
        </div>
        <div class="row">
                <div class="col-lg-6">
                    <div class="box-footer">
                    <?= Html::submitButton('Create',['class' => 'btn btn-success']) ?>
                    </div>
                </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
<?php }else{ ?>
<div class='box box-body'>
	<h3>Usul Pesanan  Obat / Alkes <?= $model->bayar->jenisbayar ?></h3>
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
		<tr>
			<td>Status Permintaan</td>
			<td>:</td>
			<td><?php 
				if($model->status == 1){
						echo 'Draf';
					}else if($model->status == 2){
						echo 'Pengajuan';
					}else if($model->status == 3){
						echo 'Pengajuan dikirim';
					}else{
						echo 'Selesai'; 
					}
			?></td>
		</tr>
	</table>
	<hr>
	<?php if($model->status > 2){
		echo'<div class="alert alert-warning" role="alert">
	<h6>Pengajuan dalam tahapan <b>( Pengajuan di kirim )</b> tidak bisa di edit , di tambah , atau di kurangi</h6>
</div>';
	}else{
	?>
	<a  href='<?= Url::to(['permintaan-barang/tambah-item?id='.$model->id]) ?>' class='btn btn-primary '>Tambah Barang</a>
	<?php } ?>
	<hr>
	<?php		
		$gridcolom = [
		['class' => 'kartik\grid\SerialColumn'],
		'namaobat',
		'qty',
		'obat.satuan.satuan',
		'harga',
		'total',
		[
		'class' => 'yii\grid\ActionColumn',
		'template' => '{view-rajal}{edit-item}',
		'buttons' => [
		'view-rajal' => function ($url,$model) {
		return Html::a(
				'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
				$url);
		},
		'edit-item' => function ($url,$model) {
		return Html::a(
				'<span class="label label-success"><span class="fa fa-pencil"></span></span>', 
				$url);
		},
		],
		],

		];
		$fullExportMenu = ExportMenu::widget([
		'dataProvider' => $dataProvider,
		'columns' => $gridcolom,
		'target' => ExportMenu::TARGET_BLANK,
		'pjaxContainerId' => 'kv-pjax-container',
		'exportContainer' => [
		'class' => 'btn-group mr-2'
		],
		'dropdownOptions' => [
		'label' => 'Full',
		'class' => 'btn btn-outline-secondary',
		'itemsBefore' => [
		'<div class="dropdown-header">Export All Data</div>',
		],
		],
		'exportConfig' => [
                  
                         ExportMenu::FORMAT_EXCEL => ['filename' => 'Penerimaan_Barang-'.$model->idpermintaan],
                     ],
        'filename' => 'Penerimaan_Barang-'.$model->idpermintaan,
		]);
	?>
	<?= GridView::widget([
			'panel' => ['type' => 'default', 'heading' => 'Daftar Pasien'],
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'pjax'=>true,
				'panel' => [
				'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon glyphicon-list-alt"></i> Obat dan Alkes</h3>',
				'type'=>'warning',
				
				'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn bg-navy']),
				
			],
			 'export' => [
        'label' => 'Page',
    ],
    'exportContainer' => [
        'class' => 'btn-group mr-2'
    ],
    // your toolbar can include the additional full export menu
    'toolbar' => [
        '{export}',
        $fullExportMenu,
		],
						
						'columns' => $gridcolom,
					]); ?>
	<hr>
	<div class='row'>
		<div class='col-md-4'>
			Keterangan : <span class="label label-info">barang di edit</span><span class="label label-default">barang tambahan</span>
		</div>
	</div>
</div>
<div class='box box-footer'>
<a href='<?= Url::to(['/permintaan-barang']) ?>' class='btn btn-default pull-right '>Simpan </a>
<?php if($model->status > 2){
		echo'';
	}else{ ?>
<a href='<?= Url::to(['/permintaan-barang/kirim?id='.$model->id]) ?>'class='btn btn-warning '>Kirim Permintaan </a>
<?php } ?>
</div>
<?php } ?>
