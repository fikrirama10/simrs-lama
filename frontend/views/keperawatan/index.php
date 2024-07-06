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
?>
<div class='box box-body'>
<h3 style="color:#7d7d7d;">Ketersediaan Tempat Tidur</h3><hr/>
<div class='row'>
		<?php foreach($jumlahkamar as $jk): ?>
	        <div class="col-md-3 col-sm-6 col-xs-12">
          <?php 
		  $jml = $jk->tempattidur - $jk->masuk;
		  $persen = floor(($jk->masuk/$jk->tempattidur)*100);
		  if($persen == 100){
		  ?>
		  
		  <div class="info-box bg-red">
		  <?php }else if($persen > 25 && $persen < 50){echo'<div class="info-box bg-aqua">';}else if($persen > 50 && $persen < 100){echo'<div class="info-box bg-yellow">';}else{echo'<div class="info-box bg-green">';}?>
            <span class="info-box-icon"><a style='color:#fff;'>
			<?php if($jk->idkelas == 1){echo"I";}else if($jk->idkelas == 2){echo"II";}else if($jk->idkelas == 3){echo"III";}else{echo"";} ?></a></span>

            <div class="info-box-content">
              <span class="info-box-text"><a style='color:#fff;' href='<?= Yii::$app->params['baseUrl'].'/dashboard/kamar/'.$jk->id?>'><?= $jk->namaruangan ?></a></span>
              <span class="info-box-number"><?= $jk->masuk ?>/<?= $jk->tempattidur?> BED</span>

              <div class="progress">
                <div class="progress-bar" style="width: <?=$persen?>%"></div>
              </div>
                  <span class="progress-description">
                    <?= $persen ?>% Terisi
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		<?php endforeach; ?>
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
						'attribute' => 'Kamar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->kamar->namaruangan;
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