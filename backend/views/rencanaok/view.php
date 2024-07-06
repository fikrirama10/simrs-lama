<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Pasien;
/* @var $this yii\web\View */
/* @var $pasien common\models\Rencanaok */
$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
$this->title = $pasien->id;
$this->params['breadcrumbs'][] = ['label' => 'Rencanaoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
?>

<div class="dokumen-view">
	<div class='panel panel-default'>
		<div class='panel-heading'>
			<h4>Detail Pasien rencana Oprasi</h4>
		</div>
		<div class='panel-body'>
			<div class='col-sm-12' style='font-size:15px; line-height:30px;'>
			
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>No RM</div>
					<div class='col-sm-9'> : <?= $pasien->no_rekmed;?></div>
				</div>
				
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Nama Pasien</div>
					<div class='col-sm-9'> : <?= $pasien->sbb ?>, <?= $pasien->nama_pasien;?></div>
				</div>
				
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>No Tlp Pasien</div>
					<div class='col-sm-9'> : <?= $pasien->nohp ;?></div>
				</div>
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Diagnosa Pasien</div>
					<div class='col-sm-9'> : <?= $model->diagnosa ;?></div>
				</div>
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Dokter</div>
					<div class='col-sm-9'> : <?= $model->dokter->namadokter ;?></div>
				</div>
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Catatan</div>
					<div class='col-sm-9'> <div class='well'> <?= $model->catatan;?></div></div>
				</div>
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Tanggapan pasien</div>
					<div class='col-sm-9'>
					<?php $form = ActiveForm::begin(); ?>
					<?php if($model->tanggapan == true){echo "<div class='well'> ".$model->tanggapan."</div>";}else{?>
					<?= $form->field($model, 'tanggapan')->widget(CKEditor::className(), [
						'options' => ['rows' => 3],
						'preset' => 'standard'
					])->label(false) ?>
					<?php } ?>
					</div></div>
				</div>
				
			</div>
			
			
			
			
			
			
		</div>
		<div class='panel-footer'>
			<p>
			<?php if($model->status == 1 ){?>
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
				<?= Html::a('Sudah di Hubungi', ['/ok/rencanaoprasi'], ['class' => 'btn btn-primary']) ?>
				<?= Html::a('Batal', ['delete', 'id' => $pasien->Id], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method' => 'post',
					],
				]) ?>
			<?php }else{ ?>
				<?= Html::a($model->stat->status, ['/ok/rencanaoprasi'], ['class' => 'btn btn-primary']) ?>
			<?php }?>
			</p>
			 <?php ActiveForm::end(); ?>
		</div>
	</div>
	

</div>
