<?php
use common\models\Obat;
use common\models\Satuan;
use common\models\Resepdokter;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;
$data = ArrayHelper::map(Obat::find()->where(['idjenisobat'=>$model->idbayar])->all(), 'noobat', 'namaobat');
$resep = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->andwhere(['DATE_FORMAT(tanggal,"%Y-%m-%d")' => date('Y-m-d')])->all();
?>
<div class='container-fluid'>
	<div class='box box-body'>
	<?php $form = ActiveForm::begin(); ?>
<div class='col-xs-12'> <?= $form->field($resepdokter, 'kodeobat')->widget(Select2::classname(), [
    'data' => $data,
    'language' => 'en',
    'options' => ['placeholder' => 'Pilih Obat'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);?></div>
 <?= $form->field($resepdokter, 'idrawat')->hiddeninput(['value'=>$model->idrawat])->label(false); ?>
 <?= $form->field($resepdokter, 'no_rekmed')->hiddeninput(['value'=>$model->no_rekmed])->label(false); ?>
 <?= $form->field($resepdokter, 'iddokter')->hiddeninput(['value'=>$model->iddokter])->label(false); ?>
<div class='col-xs-4'> <?= $form->field($resepdokter, 'jumlah')->textinput()->label('Jumlah Obat'); ?> </div>
<div class='col-xs-2'> <?= $form->field($resepdokter, 'idsatuan')->dropDownList(ArrayHelper::map(Satuan::find()->all(), 'id', 'satuan'),['prompt'=>'- Satuan -'])->label('Satuan')?> </div>
<div class='col-xs-6'> <?= $form->field($resepdokter, 'dosis')->textinput(); ?> </div>
<div class='col-xs-12'> <?= $form->field($resepdokter, 'ket')->textarea()->label('Keterangan'); ?> </div>

<div class='col-xs-12'><?= Html::submitButton('Catat', ['class' => 'btn btn-success']) ?></div>
						
<?php ActiveForm::end(); ?>
<div class='col-md-12' style='margin-top:20px;'>
	<div class='box box-body'>
	<table class="table table-hover">
		<tr>
			<th>Nama Obat</th>
			<th>Jumlah </th>
			<th>Dosis </th>
			<th>Keterangan</th>
			
			<th>#</th>
		</tr>
	<?php foreach($resep as $r):?>
		<tr>
			<td><?= $r->nobat->namaobat ?></td>
			<td><?= $r->jumlah ?> <?= $r->nobat->satuan->satuan?></td>
			<td><?= $r->dosis ?></td>
			<td><?= $r->ket ?></td>
			<td><a href='<?= Url::to(['rawatinap/deleteobat/'.$r->id]) ?>'><span class="label label-danger"><i class="fa fa-close"></i></span></td></a>
		</tr>
	<?php endforeach; ?>
	</table>
	
	</div>
	<a href='<?= Url::to(['rawatinap/'.$model->id]) ?>' class='btn btn-primary btn-xs pull-right' style='margin-bottom:10px;'>Selesai</a>
	</div>
	
</div>
	</div>
</div>
