<?php

use yii\helpers\Html;
use common\models\Pasien;
use common\models\Rawatjalan;
use kartik\grid\GridView;
use yii\web\View;
use kartik\date\DatePicker;
use common\models\Kamar;
use yii\helpers\Url;
use common\models\Dokter;
use common\models\Diagnosa;
use common\models\Rawat;
$jumlahkamar = Kamar::find()->all();
$url = 'https://simrs.rsausulaiman.com/api/kamar';
        $content = file_get_contents($url);
        $json = json_decode($content, true);
?>
<div class='box box-body'>
<h3 style="color:#7d7d7d;">Ketersediaan Tempat Tidur</h3><hr/>
<div class='row'>
	<?php for($a=0; $a < 9; $a++){?> 
	<a href='#'  data-toggle="modal" data-target="#modal-<?= $json[$a]['Id'] ?>">
		<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box" style='-webkit-box-shadow: 11px 11px 7px -6px rgba(97,97,97,1);
-moz-box-shadow: 11px 11px 7px -6px rgba(97,97,97,1);
box-shadow: 11px 11px 7px -6px rgba(97,97,97,1);'>

            <span class="info-box-icon <?= $json[$a]['Warna']?>"><i class='fa fa-bed'></i></span>
				
            <div class="info-box-content">
              <span class="info-box-text"><?= $json[$a]['Ruangan'] ?> ( <?= $json[$a]['Tempattidur'] ?> BED )</span>
              <span class="info-box-number"> <?= $json[$a]['Kosong'] ?> Kosong</span> 
			  <span class="info-box-text">Kelas <?= $json[$a]['Kelas'] ?></span>
            </div> 
			
			
            <!-- /.info-box-content -->
          </div> 
          <!-- /.info-box -->
        </div>
		</a>
	<?php } ?>
</div>
		<div class='row'>
			<div class='col-md-12 col-xs-12' >
				<div class='box box-body'>
				<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return ''.$model->pasien->nama_pasien.'<br><a><i> '.$model->idrawat.'</i></a>';
						},
					],
					[
						'attribute' => 'RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rekmed;
						},
					],
					[
						'attribute' => 'DPJP',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->iddokter == 0){
								return ' - ';
							}else{
							return $model->dokter->namadokter;
							}
						},
					],
					[
						'attribute' => 'Ruangan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						
							return $model->idruangan;
							
						},
					],
					[
						'attribute' => 'Tanggal Masuk',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('d F Y',strtotime($model->tgldaftar));
						},
					],
					[
						'attribute' => 'Jam Masuk',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('G:i A ',strtotime($model->tgldaftar));
						},
					],
					
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												Url::to(['rawatinap/'.$model->id]));
								},
								
								
								
							],
					],
					
	
					
				],
			]); ?>
			
				</div>
			</div>
		</div>
</div>
<?php foreach($jumlahkamar as $jk): ?>
<?php $rajal= Rawatjalan::find()->where(['idruangan'=>$jk->id])->andwhere(['status'=>8])->all();
	$no=1;
 ?>
<div class="modal fade" id="modal-<?= $jk->id ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?= $jk->namaruangan ?></h4>
			</div>
		<div class="modal-body">
			<div class = "container-fluid">
				<div class='row'>						
				<table class='table table-bordered'>
					<tr>
						<th>No</th>
						<th>Nama Pasien</th>
						<th>Usia</th>
						<th>Jenis Kelamin</th>
						<th>Tanggal Masuk</th>
						<th>Penjamin</th>
						<th>#</th>
					</tr>
					<?php foreach($rajal as $rj): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $rj->pasien->sbb ?> .<?= $rj->pasien->nama_pasien ?></td>
						<td><?= $rj->pasien->usia ?> th</td>
						<td><?= $rj->pasien->jenis_kelamin ?> </td>
						<td><?= $rj->tglmasuk ?> </td>
						<td><?= $rj->carabayar->jenisbayar ?> </td>
						<td><?= Html::a('<h6><span class="label label-danger">Lihat</span></h6>', ['rawatinap/'.$rj->id]) ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
				</div>
			</div>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		</div>
		</div>
	<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>
<?php endforeach; ?>
