<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\grid\EditableColumn;

?>
<div class="box box-body">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idtrx',
            'tanggal',
            'faktur',
            'bayar.jenisbayar',
        ],
    ]) ?>
	<hr>
	<h3>Data Barang Masuk</h3>
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
						
						'columns' => [
							['class' => 'kartik\grid\SerialColumn'],

							'obat.namaobat',
							'permintaan',
							'qty',
							'obat.satuan.satuan',
							'harga',
							'jumlah',
							
							
							[
								'class' => 'yii\grid\ActionColumn',
								'template' => '',
								'buttons' => [
										
										
						
										
									],
							],
							
						],
					]); ?>
					<?php if($model->status == 2){?>
					<a href='<?= Url::to(['penerimaan-barang/tambah-stok?id='.$model->id]) ?>' class='btn btn-primary'>Tambahkan Ke stok</a>
					<?php }else{echo"<span class='label label-warning'>Sudah Masuk Stok</span>";}?>
</div>
