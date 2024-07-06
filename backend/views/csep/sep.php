<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Csep */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cseps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="csep-view">

   <div class='container-fluid'>
		<div class='row'>
			<div class='col-md-3'>
				<div class='box box-body'>
					<?= $kelas['nama']?><br>
					<?= $kelas['noKartu']?><hr>
					<div class="row">
		  <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li   class="active"><a href="#tab_1-1" data-toggle="tab">P</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">S</a></li>
              <li><a href="#tab_3-2" data-toggle="tab">O</a></li>
            
              <li class="pull-left header"><i class="fa fa-th"></i> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active " id="tab_1-1">
				<a><?= $kelas['nik'] ?></a><hr>
				<a><?= $kelas['tglLahir'] ?></a><hr>
				<a>Peserta</a><hr>
				<a><?= $kelas['hakKelas']['keterangan'] ?></a><hr>
				<a><?= $kelas['provUmum']['kdProvider'] ?> - <?= $kelas['provUmum']['nmProvider'] ?></a><hr>
				<a><?= $kelas['jenisPeserta']['keterangan'] ?></a><hr>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
              
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
                
				 
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
		 
          <!-- nav-tabs-custom -->
		  
        </div>
        </div>
		</div>
	</div>
			<div class='col-md-9'>
				<div class='box box-body'>
				<h5><?= $repo['noSep'] ?><a href='' class='pull-right'>Rawat Jalan</a></h5><hr>
				<?php $form = ActiveForm::begin(); ?>
					<div class='row'>
						<div class='col-md-3' style='text-align:right;'>Spesialis/SubSpesialis</div>
						<div class='col-md-9' ><?= $form->field($model, 'spesiais')->textInput(['maxlength' => true,'value'=>$spesial,'readonly'=>true,])->label(false) ?></div>
					</div>
					<div class='row'>
						<div class='col-md-3' style='text-align:right;'>(yyyy-mm-dd) Tgl. SEP</div>
						<div class='col-md-5'><?= $form->field($model, 'tglSEP')->textInput(['maxlength' => true,'value'=>$model->tglSEP,'readonly'=>true,])->label(false) ?></div>
					</div>
					<div class='row'>
						<div class='col-md-3' style='text-align:right;'>No. MR</div>
						<div class='col-md-5'><?= $form->field($model, 'noMR')->textInput(['maxlength' => true,'value'=>$repo['peserta']['noMr'],'readonly'=>true,])->label(false) ?></div>
					</div>
					<div class='row'>
						<div class='col-md-3' style='text-align:right;'>Diagnosa</div>
						<div class='col-md-9'><?= $form->field($model, 'dignosa')->textInput(['maxlength' => true,'value'=>$repo['diagnosa'],'readonly'=>true,])->label(false) ?></div>
					</div>
					<div class='row'>
						<div class='col-md-3' style='text-align:right;'>no Telepon</div>
						<div class='col-md-9'><?= $form->field($model, 'noTlp')->textInput(['maxlength' => true,'value'=>$kelas['mr']['noTelepon'],'readonly'=>true,])->label(false) ?></div>
					</div>
					<div class='row'>
						<div class='col-md-3' style='text-align:right;'>Catatan</div>
						<div class='col-md-9'><?= $form->field($model, 'noTlp')->textArea(['row' => 6,'value'=>$repo['catatan'],'readonly'=>true,])->label(false) ?></div>
					</div>
					
					
					 <?php ActiveForm::end(); ?>
				
				<?= Html::a('Cetak SEP', ['printsep', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm pt-10','target' => '_blank']) ?>
				<?= Html::a('Hapus SEP', ['deletesep', 'id' => $model->id], ['class' => 'btn btn-danger btn-sm pt-10','data' => [
							'confirm' => 'Yakin Untuk Menghapus ini ?',
							'method' => 'post',
						],]) ?>
				</div>
			</div>
			</div>
		</div>
   </div>

</div>
