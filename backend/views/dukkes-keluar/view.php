<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use common\models\DukkesObat;
use common\models\DukkerTemporary;
use common\models\DukkesKeluarDetail;
use yii\helpers\ArrayHelper;
use yii\web\View ;
/* @var $model common\models\DukkesKeluar */
$alkes = DukkerTemporary::find()->where(['kodetrx'=>$model->kodetrx])->all();
$detail = DukkesKeluarDetail::find()->where(['kodetrx'=>$model->kodetrx])->all();
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dukkes Keluars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dukkes-keluar-view">
	<div class='box box-body'>
		<div class='row'>
		<div class='col-md-6'>
		<h3>Pengeluaran Obat Dukkes</h3><hr>
		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				
				'kodetrx',
				'tgl',
				'keterangan:ntext',
				'kegiatan',
			],
		]) ?>
		</div>
		</div>
	</div>
	<div class='box box-body'>
	
		<?php if($model->status == 1){ ?>
		<div class='row'>
			<?php $form = ActiveForm::begin(); ?>
			<div class='col-md-3'><?= $form->field($tempo, 'idobat')->dropDownList(ArrayHelper::map(DukkesObat::find()->all(), 'id', 'namaobat'),['prompt'=>'- Pilih Obat -'])->label('',['class'=>'label-class'])->label(false)?></div>
			<div class='col-md-2'><?= $form->field($tempo, 'qty')->textInput(['placeholder'=>'Jumlah Obat'])->label(false) ?></div>
			<div class='col-md-1'><?= Html::submitButton('+', ['class' => 'btn btn-success']) ?></div>
			 <?php ActiveForm::end(); ?>
		</div>
		<div class='row'>
			<div class='col-md-8'>
			
				<table class='table table-responsive'>
					<tr>
						<th>No</th>
						<th>Obat / Alkes</th>
						<th>Jumlah</th>
						<th>Hapus</th>
					</tr>
					<?php $no=1; foreach($alkes as $al): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $al->obat->namaobat ?></td>
						<td><?= $al->qty ?> - <?= $al->obat->satuan->satuan ?></td>
						<td><a href='<?= Url::to(['dukkes-keluar/hapus-obat?id='.$al->id])?>' data-confirm="Are you sure ?" class='label label-danger'>-</td>
					</tr>
					<?php endforeach; ?>
				</table>
				<a id="confirm" href='<?= Url::to(['dukkes-keluar/selesai?id='.$model->id])?>' class="btn btn-success pull-left">Selesai</a>			
			</div>			
		</div>
		<?php }else{ ?>
		<div class='row'>
			<div class='col-md-8'>			
			<h3>Data Obat / Alkes</h3><hr>
				<table class='table table-responsive'>
					<tr class='bg-info'>
						<th>No</th>
						<th>Obat / Alkes</th>
						<th>Jumlah</th>
					</tr>
					<?php $no=1; foreach($detail as $al): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $al->obat->namaobat ?></td>
						<td><?= $al->qty ?> - <?= $al->obat->satuan->satuan ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
				<a href='<?= Url::to(['/dukkes-keluar'])?>' class="btn btn-warning pull-left">Kembali</a>	
			</div>			
		</div>
		<?php }?>
	</div>
</div>
<?php 
$this->registerJs("

$('#confirm').on('click', function(event){
	age =  prompt('Masukan Kode Verifikasi?', );
	if(age == '3321'){
       return true;
    } else {
        event.preventDefault();
        return false;
    }
});

", View::POS_READY);
?>