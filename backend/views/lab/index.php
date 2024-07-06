<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use common\models\Lab;
use common\models\Pasien;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Labs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-index" style='margin-top:20px;'>
	<div class='container-fluid'>
	
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
						'attribute' => 'kodelab',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						$lab = Lab::find()->where(['kodelab'=>$model->kodelab])->groupby(['kodelab'])->one();
						$labc = Lab::find()->where(['kodelab'=>$model->kodelab])->count();
							if($labc == 0){
								return Html::a(
											'<span class="label label-warning">tidak ada data periksa</span>', 
												Url::to(['orderlab/'.$model->id]));
							}else{
							if($lab->status == 1){
							return 	Html::a(
											'<span class="label label-success">'.$model->kodelab.'</span>', 
												Url::to(['orderlab/'.$model->id]));
							}else{
									return 	Html::a(
								'<span class="label label-danger">'.$model->kodelab.'</span>', 
												Url::to(['orderlab/'.$model->id]));
							}
							}
						},
					],
					[
						'attribute' => 'idrawat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->idrawat;
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
						'attribute' => 'Nama Pasien ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$ps = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
							if($ps == null){
								return "datapasien tidak ada";
							}else{
								return $model->pasien->nama_pasien;
							}
						},
					],
					[
						'attribute' => 'Usia ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$ps = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
							if($ps == null){
								return "datapasien tidak ada";
							}else{
								return $model->pasien->usia;
							}
						},
					],
				
					[
						'attribute' => 'Jam Request ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return  date('G:i A',strtotime($model->tgl_order));
						},
					],
					[
						'attribute' => 'Tanggal Request ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return  date('d F Y',strtotime($model->tgl_order));
						},
					],
					[
						'attribute' => 'Jenis Bayar ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->rawat->carabayar->jenisbayar;
						},
					],
					[
						'attribute' => 'Pengirim ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->dokter->namadokter;
						},
					],
					// [
						// 'attribute' => 'Alamat ',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->pegawai->alamat;
						// },
					// ],
					// [
						// 'attribute' => 'Username ',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->username;
						// },
					// ],
				
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view} {update} {delete}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												Url::to(['orderlab/'.$model->id]));
								},
								'delete' => function ($url,$model) {
										return Html::a(
												'<span class="label label-danger"><span class="fa fa-trash"></span></span>', 
												Url::to(['/lab/delete/'.$model->id]),
												[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Are you sure to delete this ?'),
												'data-method' => 'post',
												]);
												
								},
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-pencil"></span></span>', 
												Url::to(['/orderlab/update/'.$model->id]));
								},
								
								
								
							],
					],
					
	
					
				],
			]); ?>
			
				</div>
				
			</div>
		</div>
	</div>
   
	
	

</div>
<?php
$script = <<< JS

setTimeout(function () {
        window.location.reload();
 }, 20000); //will call the function after 2 secs.
JS;
$this->registerJs($script);
?>