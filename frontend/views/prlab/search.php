	<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use common\models\Pasien;



?>
			
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tanggal;
						},
					],
				// [
						// 'attribute' => 'Nama Pasien',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) {
							// $pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							// if($pasien == null){
								// return'-';
							// }else{
								// return $model->pasien->nama_pasien;
							// }
						// },
					// ],
					// [
						// 'attribute' => 'tanggal Lahir',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// $pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							// if($pasien == null){
								// return'-';
							// }else{
								// return $model->pasien->tanggal_lahir;
							// }
							
						// },
					// ],
					// [
						// 'attribute' => 'RM',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
						
								// return $model->no_rekmed;
							
							
						// },
					// ],
					// [
						// 'attribute' => 'Anamesis',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// if($model->anamesisi == 1){								
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
						// },
					// ],
					
					//[
						// 'attribute' => 'Indikator Penilaian',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) {
							
								// return '<b>Presentase Kelengkapan Assesmen awal<br> medis pasien gawat darurat</b>';
							
						// },
					// ],
					// [
						// 'attribute' => 'Standar',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) {
							
								// return '100%';
							
						// },
					// ],
					// [
						// 'attribute' => 'Kelengkapan',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) {
							// $hasil = $model->anamesisi + $model->ass_psiko + $model->rx_fisik + $model->penunjang+$model->diagnosis+$model->rencanaasuhan+$model->evaluasi+$model->ttd;
							// $total = ($hasil/8)*100;
						
								// return floor($hasil).' / 8';//'<i class="fa fa-close"></i>';
							
						// },
					// ],
					// [
						// 'attribute' => 'Persentase kelengkapan',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) {
							// $hasil = $model->anamesisi + $model->ass_psiko + $model->rx_fisik + $model->penunjang+$model->diagnosis+$model->rencanaasuhan+$model->evaluasi+$model->ttd;
							// $total = ($hasil/8)*100;
						
								// return floor($total).'%';//'<i class="fa fa-close"></i>';
							
						// },
					// ],
					
					// [
						// 'attribute' => 'Keterangan',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) {
							// $hasil = $model->anamesisi + $model->ass_psiko + $model->rx_fisik + $model->penunjang+$model->diagnosis+$model->rencanaasuhan+$model->evaluasi+$model->ttd;
							// $total = ($hasil/8)*100;
							// if($total == 100){
								// return Html::a('<span class="label label-success">Lengkap</span>', ['asesmenpasien/'.$model->id]);
							// }else{
							// return Html::a('<span class="label label-danger">Tidak Lengkap</span>', ['asesmenpasien/'.$model->id]);
							// }
							//	'<i class="fa fa-close"></i>';
							
						// },
					// ],
					// [
						// 'attribute' => 'Sempel',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) {
							// if($model->sempel == 'Y'){
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
							
						// },
					// ],
					// [
						// 'attribute' => 'Pemerikasaan Fisik',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// if($model->rx_fisik == 1){								
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
						// },
					// ],
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{update}',
						'buttons' => [
						
															
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-pencil"></span></span>', 
												$url);
								},
																
								
								
							],
					],
					
	
					
				],
			]); ?>
		