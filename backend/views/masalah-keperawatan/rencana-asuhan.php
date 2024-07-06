<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MasalahKeperawatanKategori;
use common\models\MasalahKeperawatanSub;
use common\models\MasalahKeperawatanDiagnosa;
use common\models\MasalahKeperawatanRencanaasuhan;
use common\models\Rencanaasuhan;
use common\models\RencanaasuhanKategori;
use yii\helpers\Url;

$kategori = RencanaasuhanKategori::find()->all();
/* @var $this yii\web\View */
/* @var $model common\models\MasalahKeperawatan */
/* @var $form yii\widgets\ActiveForm */
?>
<div class='box box-danger'>
	<div class='box-header '>
		<h1>Rencana Asuhan Keperawatan</h1>
	</div>
	<div class='box-body'>
		<h5>Masalah Keperawatan</h5><hr>
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Masalah Keperawatan</span>
			<input type='text' class='form-control' readonly value='<?= $masalah->kategori->kategori ?> (<?= $masalah->sub->subkategori ?>)'>
		</div>
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Diagnosis Keperawatan</span>
			<input type='text' class='form-control' readonly value='<?= $masalah->diagnosis->kode ?> - <?= $masalah->diagnosis->diagnosis ?>'>
		</div>
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Detail Diagnosis</span>
			<input type='text' class='form-control' readonly value=' <?= $masalah->subdiagnosis->tindakan ?>'>
		</div>
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Intervensi Keperawatan</span>
			<input type='text' class='form-control' readonly value=' <?= $model->intervensi->intervensi ?>'>
		</div>
		<hr>
	</div>
	<div class='box-body'>
		<div class='row'>
			<div class='col-md-6'>
			<?php $form = ActiveForm::begin(); $pass=2;?>
				<?= $form->field($asuhan, 'idkategorirencana')->dropDownList(ArrayHelper::map(RencanaasuhanKategori::find()->all(), 'id', 'kategori'),['prompt'=>'- Kategori Masalah -','required'=>true,'onchange'=>'$.get("'.Url::toRoute('masalah-keperawatan/list-asuhan?kode='.$model->idintervensi.'').'",{ id: $(this).val()}).done(function( data ) 
				{
				$( "select#masalahkeperawatanrencanaasuhan-idrencana" ).html( data );
				});

				'])->label('Jenis Rencana Asuhan')?>
				<?= $form->field($asuhan, 'idrencana')->dropDownList(ArrayHelper::map(Rencanaasuhan::find()->where(['id'=>0])->all(), 'id', 'rencana'),['prompt'=>'- Pilih Rencana Asuhan -','required'=>true])->label('Dokter',['class'=>'label-class'])->label('Rencana Asuhan')?>
				<div class="form-group">
				<?= Html::submitButton('+', ['class' => 'btn btn-success']) ?>
				</div>
			<?php ActiveForm::end(); ?>
			</div>
			<div class='col-md-6'>
				<table class='table table-bordered'>
					<?php foreach($kategori as $kat){ 
						$rencana = MasalahKeperawatanRencanaasuhan::find()->where(['iddetail'=>$model->id])->andwhere(['idkategorirencana'=>$kat->id])->all();
						$r = MasalahKeperawatanRencanaasuhan::find()->where(['iddetail'=>$model->id])->andwhere(['idkategorirencana'=>$kat->id])->count();
					?>
					<tr>
						<td><?= $kat->kategori ?></td>
						<td>
						<?php foreach($rencana as $r){  ?>
						<a data-confirm='Yakin menghapus data ???' href='<?= Url::to(['masalah-keperawatan/item-rencana?id='.$r->id]) ?>'><span class="label label-primary"><?= $r->rencana->rencanaasuhan ?></span></a>
						<?php } ?>
						</td>
					</tr>
					<?php } ?>
				</table>
				<a href='<?= Url::to(['masalah-keperawatan/rencana-selesai?id='.$model->id]) ?>' class='btn bg-orange'>Simpan Data</a>
			</div>
		</div>
		
	</div>
</div>