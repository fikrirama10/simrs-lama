<?php
use common\models\Rxfisik;
use common\models\Rxlabor;
use common\models\Diagnosa;
use common\models\Keluhan;
use common\models\Tindakandokter;
use common\models\Tindakan;
use kartik\select2\Select2;
use common\models\Resepdokter;
use common\models\Obat;
use common\models\Lab;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
$rxfisik = Rxfisik::find()->where(['no_rawat'=>$model->idrawat])->one();
$rxfisikc = Rxfisik::find()->where(['no_rawat'=>$model->idrawat])->count();
$keluhan = Keluhan::find()->where(['kode_p'=>$model->idrawat])->one();
$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->all();
$resep = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->all();
 $instArray =ArrayHelper::map(Obat::find()->all(), 'id', 'namaobat');

?>   
<div class='container-fluid'>
	<div class='row'>
		    <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Pasien</h3>

              <div class="box-tools">
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>RM</th>
                  <th>Id Rawat</th>
                  <th>Nama Pasien</th>
                 
                  <th>Diagonsa Awal</th>
                </tr>
                <tr>
				<td><?= $model->no_rekmed ?></td>
				<td><?= $model->idrawat ?></td>
                <td><?= $model->pasien->nama_pasien?></td>
               
                <td><?= $model->kdiagnosa?></td>
                </tr>

              </table>
            </div>
			<div class='box-footer'>
			<?php if($rxfisikc > 0){ ?>
			<div class="box box-info">
				<div class="box-header">Anamnesis</div>
				<div class="box-body">
					<div class='row' >
						<div class='col-xs-4'> Keluhan </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->keluhan ?> </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Riwayat Penyakit Sekarang </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->rwt_penyakits ?> </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Alergi</div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->alergi ?> </div>
					</div>
					
			
			</div>	
			</div>
			<?php if($model->idpoli == 1){echo"";}else{?>
				<div class="box box-danger">
				<div class="box-header">Pemeriksaan Fisik</div>
				<div class="box-body">
					<div class='row'>
						<div class='col-xs-4'> Status Lokalis</div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'><div class='panel panel-default panel-body'> <?= $rxfisik->rx_fisik ?> </div></div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Tinggi Badan </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $rxfisik->tinggibadan ?> cm </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Berat Badan </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $rxfisik->beratbadan ?>Kg </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Kesadaran </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $rxfisik->kesadarann->kesadaran ?> </div>
					</div>
				
					 <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/asesmen/update/'.$model->id?>' class="btn btn-success btn-xs pull-right">Edit</a>
				</div>
				
			</div>
			<?php }?>			
			<div class="box box-danger">
				<div class="box-header">Laboratorium</div>
				<div class="box-body">
				<?php //if($labc == 0){echo"<center>Tidak Ada Pemeriksaan Lab</center>";}else{?>
				<table class="table table-hover">
                <tr>
                  <th>Pemeriksaan Lab</th>
                </tr>
				<?php //foreach($lab as $l):?>
                <tr>
			
				<td><?php // $l->dlab->namapemeriksaan ?></td>
                </tr>
				<?php //endforeach; ?>
				

              </table>
				<?php //} ?>
				</div>
			</div>	
            <!-- /.box-body -->
          </div>
			<?php }else{echo"";} ?>
          <!-- /.box -->
        </div>
	</div>
</div>

   <div class="row">
    
		  <div class="col-md-8">
		  <div class="row">
		  <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#tab_1-1" data-toggle="tab">Tindakan Dokter</a></li>
              <li  class="active"><a href="#tab_2-2" data-toggle="tab">Medikamentosa</a></li>
              <li><a href="#tab_3-2" data-toggle="tab">Tindak Lanjut</a></li>
            
              <li class="pull-left header"><i class="fa fa-th"></i> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane " id="tab_1-1">
              
              <table class="table table-hover">
                <tr>
                  <th>Nama Tindakan</th>
                  <th>Dokter Penindak</th>
                 
                </tr>
				<?php foreach($tindakan as $t):?>
                <tr>
				<?php if($t->idtindakan == null){ ?>
				<td><?= $t->idtindakan ?></td>
				<td><?= $t->dokter->namadokter ?></td>
				<?php } else {?>
				<td><?= $t->tindakandokter->namatindakan ?></td>
				<td><?= $t->dokter->namadokter ?></td>
				<?php } ?>
                </tr>
				<?php endforeach; ?>
				

              </table>
				
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_2-2">
                <table class="table table-hover">
                <tr>
                  <th>Nama Obat</th>
                  <th>Dosis</th>
                  <th>Jumlah</th>
                 
                </tr>
				<?php foreach($resep as $a): ?>
                <tr>
				<td><?= $a->nobat->namaobat ?></td>
				<td><?= $a->dosis ?></td>
				<td><?= $a->jumlah ?></td>
                
                </tr>
				<?php endforeach; ?>

              </table>
				  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-obat">
                + Obat
              </button>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
              
				   <a href='<?= Url::to(['rawatjalan/lab/'.$model->id])?>' class="btn btn-success btn-md">Laboratorium </a>
				   <a href='<?= Url::to(['radiologi/create/'.$model->id])?>' class="btn btn-warning btn-md">Radiologi </a>
				   <a href='<?= Url::to(['asesmen/igdrawat/'.$model->id])?>' class="btn btn-danger btn-md">Rawat </a>
				  <?php if($model->idpoli == 5){?>
				  <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/pasien/rawatinap/'.$model->pasien->id?>' class="btn btn-default btn-md">USG</a>
				  <?php }else{echo"";} ?>
				  <?php if($model->idpoli == 3){ ?>
				   <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/rencanaok/create/'.$model->id?>' class="btn btn-default btn-md">Rencana Oprasi</a>
				  <?php }else{echo"";}?>
				 
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
		 
          <!-- nav-tabs-custom -->
		  
        </div>
        </div>
        </div>
	<div class='col-md-4'>
		<div class="box box-primary">
			<div class="box-body box-profile">
			
               <strong><i class="fa fa-venus-mars margin-r-5"></i> Jenis Kelamin</strong>

              <p class="text-muted">
				<?php if($model->pasien->jenis_kelamin == 'L'){echo"Laki - Laki";}else{echo"Perempuan";}?>
              </p>

              <hr>

              <strong><i class="fa fa-birthday-cake margin-r-5"></i>Tanggal Lahir </strong>

              <p class="text-muted"><?= $model->pasien->tanggal_lahir?> ( <?=$model->pasien->usia?>th )</p>

              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?= $model->pasien->alamat?></p>

              <hr>
			  <strong><i class="fa fa-balance-scale margin-r-5"></i> Agama</strong>

              <p class="text-muted"><?= $model->pasien->agama?></p>

              <hr>
              
            </div>
			<div class='box box-footer'>
				 <?php if($model->status == 7){echo" <a class='btn btn-primary pull-right'>Kembali</a>";}else{?>	
		  <a href='<?= Url::to(['rawatjalan/selesai/'.$model->id])?>' class="btn btn-primary pull-right">Simpan</a>	
<?php } ?>		  
			</div>
            <!-- /.box-body -->
          </div>
	</div>
	
      </div>

	  
	  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
               <div class='row'>
							 <?php $form = ActiveForm::begin(); ?>
								 
								
								 <?= $form->field($tindakandokter, 'kode_rawat')->hiddeninput(['value'=>$model->idrawat])->label(false); ?>
								 <?= $form->field($tindakandokter, 'penindak')->hiddeninput(['value'=>$model->iddokter])->label(false); ?>
								<div class='col-xs-12'> <?= $form->field($tindakandokter, 'idtindakan')->dropDownList(ArrayHelper::map(Tindakan::find()->all(), 'id', 'namatindakan'),['prompt'=>'- Tindakan Dokter -'])?> </div>
								
								<div class='col-xs-12'> <?= $form->field($tindakandokter, 'ditindakoleh')->textinput(); ?> </div>
								<div class='col-xs-12'> <?= $form->field($tindakandokter, 'tarif')->hiddeninput()->label(false); ?> </div>
								<div class='col-xs-12'></div>
								
							</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Tindak', ['class' => 'btn btn-success']) ?>
				<?php ActiveForm::end(); ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

		<div class="modal fade" id="modal-obat">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
             <div class='row'>
					 <?php $form = ActiveForm::begin(); ?>
						 
						
						 <?= $form->field($resepdokter, 'idrawat')->hiddeninput(['value'=>$model->idrawat])->label(false); ?>
						<div class='col-xs-12'> 
						<?= $form->field($resepdokter, 'kodeobat')->widget(Select2::classname(), [
						'data' => $instArray,
						'language' => 'en',
						'options' => [

						'placeholder' => 'Pilih Obat'],
						'pluginOptions' => [
						'allowClear' => true
							
						],
					])->label(false);?>
						</div>
						<div class='col-xs-12'> <?= $form->field($resepdokter, 'dosis')->textinput(); ?> </div>
						<div class='col-xs-12'> <?= $form->field($resepdokter, 'ket')->textinput()->label('Keterangan'); ?> </div>
						<div class='col-xs-12'> <?= $form->field($resepdokter, 'jumlah')->textinput()->label('Jumlah Obat'); ?> </div>
						
							<div class='col-xs-12'><?= Html::submitButton('Catat', ['class' => 'btn btn-success']) ?></div>
							
						
    <?php ActiveForm::end(); ?>
					</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
