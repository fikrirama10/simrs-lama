
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Tindakan;
use yii\helpers\ArrayHelper;
use common\models\Resepdokter;
use kartik\select2\Select2;
use yii\web\View;
use yii\web\JsExpression;
use common\models\Rawatjalan;
use common\models\Lab;
use common\models\Trandetail;
use common\models\Transaksi;
use common\models\Trandokter;
use yii\helpers\Url;

?>

<div class='box'>
	<div class='box box-body'>
		<div class='box box-header'><h3>Data Bayar Pasien</h3></div>
		<div class='container-fluid'>
			<div class='row'>
				<div class='col-md-4'>
					<div class='form-group'>
						<input type='text' class='form-control' value='<?= $model->no_rekmed?>' readonly>
						<input type='text' class='form-control' value='<?= $model->pasien->sbb?>.<?= $model->pasien->nama_pasien?>' readonly>
						<input type='text' class='form-control' value='<?= $model->carabayar->jenisbayar?>' readonly>
						<input type='text' class='form-control' value='<?= $model->tgldaftar?>' readonly>
					</div>
				</div>
				<div class='col-md-8'>
				
					 <?php $form = ActiveForm::begin(); ?>
				
					 <div class='row'>
						<div class='col-md-8'>
					    <?= $form->field($tra, 'kodedokter')->dropDownList(ArrayHelper::map(Trandokter::find()->all(), 'id', 'namadokter') ,['prompt' => 'Pilih Dokter','required'=>true])->label('Kode Dokter')?>
						</div>
						<div class='col-md-1'>
						 <label><br></label>
							<?= Html::submitButton('Edit', ['class' => 'btn btn-primary']) ?>
						
						</div>
					</div>
					 <?php ActiveForm::end(); ?>
				
				</div>
			</div>
		</div>
	</div>
</div>
