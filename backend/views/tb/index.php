<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;
$this->title = 'Pasien Rawat';
$this->params['breadcrumbs'][] = $this->title;
?>
	
<div class="aspirasi-index" style='margin-top:20px;'>
	
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h3>Pasien Rawat Jalan</h3>
		</div>
		
		<div class='box-body'>
			
		<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
			
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
			//	'showPageSummary' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],
					'no_rekmed',				
					[
						'attribute' => 'Nama Pasien ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nama_pasien;
						},
					],
					[
						'attribute' => 'Alamat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->alamat;
						},
					],
					
					
					
					
					
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								
								
														
							
								
							],
					],
					
	
					
				],
			]); ?>
		</div>
	</div>
</div>
