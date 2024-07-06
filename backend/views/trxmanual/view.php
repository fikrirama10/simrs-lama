
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Tindakan;
use yii\helpers\ArrayHelper;
use common\models\Resepdokter;
use kartik\select2\Select2;
use common\models\Rawatjalan;
use common\models\Lab;
use common\models\Trxmanualdetail;
use common\models\Transaksi;
use yii\helpers\Url;

$data = ArrayHelper::map(Tindakan::find()->all(), 'id', 'namatindakan','tarif');
$transd = Trxmanualdetail::find()->where(['trxid'=>$model->trxid])->all();
$no=1;
?>

<div class='box'>
	<div class='box box-body'>
		<div class='box box-header'><h3>Data Bayar Pasien</h3></div>
		<div class='container-fluid'>
			<div class='row'>
				<div class='col-md-4'>
					<div class='form-group'>
						<input type='text' class='form-control' value='<?= $model->nama?>' readonly>
						<input type='text' class='form-control' value='<?= $model->usia?>' readonly>
						<input type='text' class='form-control' value='<?= $model->alamat?>' readonly>
						<input type='text' class='form-control' value='<?= $model->ket?>' readonly>
				</div>
				</div>
				<div class='col-md-8'>
				
					 <?php $form = ActiveForm::begin(); ?>
				
					 <div class='row'>
						<div class='col-md-8'><?= $form->field($trx, 'idtindakan')->widget(Select2::classname(), [
						'data' => $data,
						'language' => 'en',
						'options' => ['placeholder' => 'Pilih Tindakan'],
						'pluginOptions' => [
						'autofocus' => 'autofocus',
							'allowClear' => true,
							
						],
						])->label('Tindakan');?>
						</div>
						<div class='col-md-2'> <?= $form->field($trx, 'jumlah')->label("Jumlah "); ?></div>
						<div class='col-md-1'>
						 <label><br></label>
							<?= Html::submitButton('+', ['class' => 'btn btn-primary']) ?>
						
						</div>
					</div>
					 <?php ActiveForm::end(); ?>
				
				</div>
			</div>
		</div>
	</div>
	<div class='box box-body'>
		<div class='container-fluid'>
		<table class='table table-bordered'>
			<tr>
				<th>No</th>
				<th>Tindakan</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Total</th>
				<th>#</th>
			</tr>
			<?php foreach($transd as $td): ?>
			<tr>
				<td><?= $no++?></td>
				<td><?= $td->tindakan->namatindakan ?> </td>
				<td><?= $td->jumlah ?> Kali</td>
				<td>Rp. <?= $td->harga ?></td>
				<td>Rp. <?= $td->harga * $td->jumlah ?></td>			
				<td><a href='<?= Url::to(['trxmanual/deletetind/'.$td->id]) ?>'><span class="label label-danger"><i class="fa fa-close"></i></span></a></td>				
			</tr>
			<?php endforeach; ?>
		</table>
		<?php if($model->status == 1){ ?>
			<a href='<?= Url::to(['trxmanual/beres/'.$model->id])?>' class="btn btn-primary pull-right">Selesai</a>	
			<a href='<?= Url::to(['trxmanual/beres/'.$model->id])?>' class="btn btn-warning ">Print</a>	
		<?php }else{  ?>
			<a href='<?= Url::to(['trxmanual/selesai/'.$model->id])?>' class="btn btn-primary pull-right">Bayar</a>	
		<?php } ?>
		</div>
	</div>
</div>
</div>