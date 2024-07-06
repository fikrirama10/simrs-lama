<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\Jenisbayar;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\BarangMasuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-masuk-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <?=	$form->field($barang, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label('Tanggal');?>
    <?= $form->field($barang, 'faktur')->textInput() ?>
    <?= $form->field($barang, 'jenisbarang')->hiddenInput(['value'=>$model->jenis])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	Barang
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

							'namaobat',
							'idpermintaan',							
							'qty',
							'obat.jenis.jenisbayar',
							'obat.satuan.satuan',
							'harga',
							'total',
							
							
							[
								'class' => 'yii\grid\ActionColumn',
								'template' => '',
								'buttons' => [
										
										
						
										
									],
							],
							
						],
					]); ?>
</div>
