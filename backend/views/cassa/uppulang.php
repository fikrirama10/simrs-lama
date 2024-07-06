
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
use common\models\Trandokter;
use common\models\Trandetail;
use common\models\Transaksi;
use yii\helpers\Url;
use kartik\date\DatePicker;
?>

<div class='box'>
	<div class='box box-body'>
		<h4>Pembayaran</h4><hr>
		<div class='col-md-4'>
					<div class='form-group'>
						<input type='text' class='form-control' value='<?= $model->no_rekmed?>' readonly>
						<input type='text' class='form-control' value='<?= $model->idrawat?>' readonly>
						<input type='text' class='form-control' value='<?= $model->pasien->sbb?>.<?= $model->pasien->nama_pasien?>' readonly>
						<input type='text' class='form-control' value='<?= $model->jerawat->jenisrawat?>' readonly>
						<input type='text' class='form-control' value='<?= $model->carabayar->jenisbayar?>' readonly>
						<?php if($model->idjenisrawat == 1){?>
						<input type='text' class='form-control' value='<?= $model->polii->namapoli?>' readonly>
						<?php }else if($model->idjenisrawat == 2){ ?> 
						<input type='text' class='form-control' value='<?= $model->kelas->namakelas?>' readonly>
						<?php }else{ ?>
						
						<?php }?>
					</div>
				</div>
		<div class='col-md-3'>
		 <?php $form = ActiveForm::begin(); ?>
			<label>Tanggal masuk</label>
			<?php if($model->idjenisrawat == 2 ){  ?>
			<input type='text' class='form-control' value='<?= date('Y/m/d',strtotime($model->tgldaftar))?>' readonly>
			<?= $form->field($model, 'tglkbayar')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd',
					'todayHighlight' => true,
					]
					])->label('Tanggal pulang')?>
			<?php }else{?>
			
			<input type='text' class='form-control' value='<?= date('Y/m/d',strtotime($model->tgldaftar))?>' readonly>
			<label>Tanggal Pulang
			<input type='text' id='rawatjalan-tglkbayar' name='Rawatjalan[tglkbayar]' class='form-control' value='<?= date('Y-m-d',strtotime($model->tgldaftar))?>' readonly /></label>
			<?php } ?>
			 <?= $form->field($model, 'drbayar')->dropDownList(ArrayHelper::map(Trandokter::find()->all(), 'id', 'namadokter') ,['prompt' => 'Pilih Dokter','required'=>true])->label(false)?>
			
					<?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
		 <?php ActiveForm::end(); ?>
		
		</div>
		
	</div>
</div>