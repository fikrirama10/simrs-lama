<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Dipublikasikan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokumen-index">
	<div class='panel panel-default'>
		<div class='panel-heading'>
			<h4>
				<?= Html::encode($this->title);?>
				<p class='pull-right'>
				<?= Html::a('<i class="fa fa-edit"></i> Input Dokumen', ['create'], ['class' => 'btn btn-success mbot10']); ?>
				<?= Html::a('<i class="fa fa-print"></i> Cetak', ['report-all'], ['class' => 'btn btn-primary mbot10','target' => '_blank']); ?>
				</p>
			</h4>
		</div>
		<div class='panel-body'>
			 <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'options' =>['class' =>'table table-responsive'],
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					 
					[
						'label' => 'JUDUL',
						'attribute' => 'Judul',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return Html::a('<div class="fitcolumn">'.$model->Judul.'</div>', ['view', 'id' => $model->Id]);
						},
					],
					
					[
						'label' => 'KATEGORI',
						'attribute' => 'kategori.Kategori',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return ($model->kategori->Kategori .'<br/>'.$model->jenis->Jenis);
						},
					],					
					[
						'label' => 'PENERBIT',
						'attribute' => 'skpd.Institusi',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return ($model->skpd->Institusi .'<br/>'.$model->skpd->ppid->PPID);
						},
					],
								
					
					// 'IdType',
					// 'FileName',
					// 'FileSize',
					// 'FileExt',
					// 'Requested',
					// 'Publisher',
					// 'IdStat',
					// 'PublishDate',
					// 'Deskripsi:ntext',
					// 'UserId',
					
					// 'Keterangan',

					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view} {update} {delete}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
														
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-success"><span class="fa fa-pencil"></span></span>', 
												$url);
								},
																
								'delete' => function ($url,$model) {
										return Html::a(
												'<span class="label label-danger"><span class="fa fa-close"></span></span>', 
												$url,
												[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Anda Yakin akan menghapus Data?'),
												'data-method' => 'post',
												]);
								},
							],
					],
				],
			]); ?>
		</div>
	</div>
</div>
