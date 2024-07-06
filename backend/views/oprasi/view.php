<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Dokter;
use common\models\Petugas;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Oprasi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Oprasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oprasi-view">
    <?php $form = ActiveForm::begin(); ?>

	<div class='box box-body'>
	<h3>Oprasi</h3><hr>
		<div class='row'>
			<div class='col-md-3'>
				<table class='table'>
					<tr>
						<td>Id Oprasi</td>
						<td>: <?= $model->idoprasi?></td>
					<tr>
					<tr>
						<td>No RM</td>
						<td>: <?= $model->no_rekmed?></td>
					<tr>
					<tr>
						<td>Nama Pasien</td>
						<td>: <?= $model->pasien->nama_pasien?> (<?= $model->pasien->jenis_kelamin ?>)</td>
					<tr>
					<tr>
						<td>Usia</td>
						<td>: <?= $model->pasien->usia?> th</td>
					<tr>
					<tr>
						<td>Alamat</td>
						<td>: <?= $model->pasien->alamat?></td>
					<tr>
				</table>
			</div>
			<div class='col-md-5'>
			<?php if($model->juduloprasi == null ){ ?>
				 <?= $form->field($model, 'juduloprasi')->textInput(['maxlength' => true])->label('Judul Oprasi') ?>
			<?php }else {echo "<h3>Judul Oprasi : ".$model->juduloprasi.'</h3>';}?>
				 <div class='row'>
					<div class='col-md-6'>
					<h5>Dokter Bedah</h5><hr>
					<?php if($model->dokterbedah1 == null && $model->dokterbedah2 == null){ ?>
					<?= $form->field($model, 'dokterbedah1')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'),['prompt'=>'Dokter Bedah 1'])->label('Kelurahan',['class'=>'label-class'])->label(false)?>
					<?= $form->field($model, 'dokterbedah2')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'),['prompt'=>'Dokter Bedah 2 (ass)'])->label('Kelurahan',['class'=>'label-class'])->label(false)?>
					<?php }else{ ?>
					Dokter bedah 1 : <?= $model->dokterbedah1 ?><br>
					<?php if($model->dokterbedah2 == null){echo"Dokter bedah 2 :";}else{?>
					Dokter bedah 2 : <?= $model->dokterbedah2 ?>
					<?php }}?>
					</div>
					<div class='col-md-6'>
					<h5>Perawat Bedah</h5><hr>
					<?php if($model->perawat1 == null && $model->perawat1 == null){ ?>
					<?= $form->field($model, 'perawat1')->dropDownList(ArrayHelper::map(Petugas::find()->where(['unit'=>8])->all(), 'id', 'nama_petugas'),['prompt'=>'Perawat Bedah 1'])->label('Kelurahan',['class'=>'label-class'])->label(false)?>
					<?= $form->field($model, 'perawat2')->dropDownList(ArrayHelper::map(Petugas::find()->where(['unit'=>8])->all(), 'id', 'nama_petugas'),['prompt'=>'Perawat Bedah 2'])->label('Kelurahan',['class'=>'label-class'])->label(false)?>
					<?php }else{ ?>
					Perawat bedah 1 : <?= $model->perawat1 ?><br>
					<?php if($model->perawat2 == null){echo"Perawat bedah 2 :";}else{?>
					Perawat bedah 2 : <?= $model->perawat2 ?>
					<?php }}?>
					
					</div>
					
				 </div>
			</div>
			<div class='col-md-4'>
			<?php if($model->diagnosapra == null){?>
				<?= $form->field($model, 'd1')->textinput(['placeholder' => 'KODE DIAGNOSA','onkeyup'=>'$.get("'.Url::toRoute('tes/listdiagnosa/').'",{ id: $(this).val() }).done(function( data ) 
									{
										  $( "select#oprasi-diagnosapra" ).html( data );
										  });'])->label('Diagnosa Pra Oprasi') ?>
										  
										   <select id="oprasi-diagnosapra" class="form-control" name='Oprasi[diagnosapra]' aria-invalid="false"></select><br>
			<?php }else{?>
				<?= $model->diagnosapra ?>
			<?php } if($model->diagnosapasca == null){?>
			<?= $form->field($model, 'd2')->textinput(['placeholder' => 'KODE DIAGNOSA','onkeyup'=>'$.get("'.Url::toRoute('tes/listdiagnosa/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#oprasi-diagnosapasca" ).html( data );
								  });'])->label('Diagnosa Pasca Oprasi') ?>
								  
								   <select id="oprasi-diagnosapasca" class="form-control" name='Oprasi[diagnosapasca]' aria-invalid="false"></select>
			</div>
			<?php }else{echo "Diagnosa Pasca  Oprasi :" .$model->diagnosapasca;}?>
		</div>
		
    </div>
	<div class='box box-footer'>
	<div class="form-group">
		<?php if($model->diagnosapra == null){ ?>
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
		<?php }else{ ?>
		 <?= Html::submitButton('Selesai', ['class' => 'btn btn-success']) ?>
		<?php } ?>
    </div>
	</div>
	</div>
<?php ActiveForm::end(); ?>
</div>
