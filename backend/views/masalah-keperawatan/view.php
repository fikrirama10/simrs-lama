<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MasalahKeperawatanIntervensi;
use common\models\MasalahKeperawatanDetail;
/* @var $this yii\web\View */
/* @var $model common\models\MasalahKeperawatan */
$intervensi = MasalahKeperawatanDetail::find()->where(['idmasalah'=>$model->id])->all();
$this->title = 'Diagnosis Keperawatan';
$this->params['breadcrumbs'][] = ['label' => 'Masalah Keperawatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$no=1;
?>
<div class="masalah-keperawatan-view">
	<div class="box">
		<div class="box-header">
		 <h1><?= Html::encode($this->title) ?></h1>
		</div>
		<div class="box-body">

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idrawat',
            'no_rekmed',
            'tgl',
            'kategori.kategori',
            'sub.subkategori',
            'diagnosis.diagnosis:ntext',
            'subdiagnosis.tindakan',
            'tindakan:ntext',
        ],
    ]) ?>
			<hr>
			<h3>Intervensi</h3>
			
			<div class='row'>
				<div class='col-md-6'>
					
					<?php $form = ActiveForm::begin(); ?>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Diagnosis Keperawatan</span>
						<input type='text' class='form-control' readonly value='<?= $model->diagnosis->kode ?> - <?= $model->diagnosis->diagnosis ?>'>
					</div>
					<hr>
					 <?= $form->field($detail, 'idintervensi')->dropDownList(ArrayHelper::map(MasalahKeperawatanIntervensi::find()->where(['iddiagnosis'=>$model->iddiagnosis])->all(), 'id', 'intervensi'),['prompt'=>'- Pilih Tindakan -'])->label('Dokter',['class'=>'label-class'])->label('Intervensi')?>
					 <div class="form-group">
						<?= Html::submitButton('+', ['class' => 'btn btn-success']) ?>
					</div>
					<?php ActiveForm::end(); ?>
				</div>
				<div class='col-md-6'>
					<table class='table table-bordered'>
						<tr>
							<th>No</th>
							<th>Intervensi</th>
							<th>Rencana Asuhan</th>
							<th>Delete</th>
						<tr>
						<?php if($intervensi){ 
							foreach($intervensi as $inv):
						?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $inv->intervensi->intervensi ?></td>
							<td><a href='<?= Url::to(['masalah-keperawatan/rencana-asuhan?id='.$inv->id]) ?>'><span class="label label-success"><i class="fa fa-pencil"></i> rencana asuhan</span></a></td>
							<?php if($inv->status == 2){
								echo"<td></td>";
							}else{ ?>
							<td><a href='<?= Url::to(['masalah-keperawatan/rencana-asuhan?id='.$inv->id]) ?>'><span class="label label-danger"><i class="fa fa-trash"></i> </span></a></td>
							<?php } ?>
						</tr>
						<?php endforeach; ?>
						<?php }else{ ?>
						<tr>
							<td colspan='3'>Belum ada data</td>
						</tr>
						<?php } ?>
					</table>
					<a href='<?= Url::to(['masalah-keperawatan/asuhan-selesai?id='.$model->id]) ?>' class='btn bg-purple'>Selesai</a>
				</div>
			</div>
			

		</div>
		
	</div>
</div>
