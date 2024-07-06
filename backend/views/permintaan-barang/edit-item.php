<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\widgets\TabularInput;
use yii\widgets\ActiveForm;
use common\models\PermintaanBarangDetail;
use yii\helpers\Url;


?>
<div class='box'>
	<div class='box-header'>
		<h4>Edit Item</h4>
	</div>
	<div class='box-body'>
	<div class='row'>
		<div class='col-md-5'>
			<table class='table table-bordered'>
			<tr>
				<td width=200>Nomer Permintaan</td>
				<td width=10>:</td>
				<td><?= $pengajuan->idpermintaan ?></td>
			</tr>
			<tr>
				<td>Tanggal Permintaan</td>
				<td>:</td>
				<td><?= $pengajuan->tanggal ?></td>
			</tr>
			<tr>
				<td>Nama Item</td>
				<td>:</td>
				<td><?= $model->namaobat ?></td>
			</tr>
			<tr>
				<td>Stok Real</td>
				<td>:</td>
				<td><?= $model->sisastok ?> <?= $model->obat->satuan->satuan ?></td>
			</tr>
			</table>
		</div>
	</div>
	<div class='row'>
		<div class='col-md-5'>
		<?php $form = ActiveForm::begin(); ?>
			<?= $form->field($model, 'qty')->textInput(['maxlength' => true]) ?>
		
		</div>
	</div>
		
	</div>
	<div class="box-footer">
		<?= Html::submitButton('Edit',['class' => 'btn btn-success']) ?>
	</div>
	<?php ActiveForm::end(); ?>
</div>