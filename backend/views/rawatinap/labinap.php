
<?php
$no = 1;
use common\models\Tindakandokter;
use common\models\Tindakan;
use common\models\Resepdokter;
use common\models\Obat;
use yii\helpers\Url;
use common\models\Lab;
use yii\helpers\Html;
use common\models\Daflab;
use common\models\Kattindakanlab;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$tindakan = Lab::find()->where(['idrawat'=>$model->idrawat])->all();
$resep = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->all();
?>   
   <div class="row">
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
                  <th>Status</th>
                  <th>Diagonsa Awal</th>
                </tr>
                <tr>
				<td><?= $model->no_rekmed ?></td>
				<td><?= $model->idrawat ?></td>
                <td><?= $model->pasien->nama_pasien?></td>
                <td><span class="label label-success">Approved</span></td>
                <td><?= $model->kdiagnosa?></td>
                </tr>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		<div class="col-md-8">
			<div class='box box-primary'>
				<div class='box-header'><h4>Order Lab</h4></div>
				<div class='box-body'>
				<table class="table table-hover">
                <tr>
                  <th>No</th>
                  <th>Nama Tindakan Lab</th>
                  <th>Jenis Tindakan Lab</th>
                 
                 
                </tr>
				<?php foreach($tindakan as $t):?>
                <tr>
				<td><?= $no++ ?></td>
        <td><?= $t->dlab->namapemeriksaan ?></td>
				<td><?= $t->katlab->nama ?></td>
                </tr>
				<?php endforeach; ?>
				

              </table>
			  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-obat">
                + Lab
              </button>
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
               <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/rawatinap/'.$model->id?>' class="btn btn-success btn-xs pull-right">Simpan</a>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
      </div>

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
						 
						
						<?= $form->field($labora, 'idrawat')->hiddeninput(['value'=>$model->idrawat])->label(false); ?>
						<?= $form->field($labora, 'idpengirim')->hiddeninput(['value'=>$model->iddokter])->label(false); ?>
						<?= $form->field($labora, 'no_rekmed')->hiddeninput(['value'=>$model->no_rekmed])->label(false); ?>
						<div class='col-xs-12'> <?= $form->field($labora, 'idjenisp')->dropDownList(ArrayHelper::map(Daflab::find()->all(), 'id', 'namapemeriksaan'),['prompt'=>'- Tindakan Lab -','onchange'=>'$.get("'.Url::toRoute('lab/lablist/').'",{ id: $(this).val() }).done(function( data ) 
                {
                  $( "select#lab-idkatjenisp" ).html( data );
                });
                '])?> 
                   <?= $form->field($labora, 'idkatjenisp')->dropDownList(ArrayHelper::map(Kattindakanlab::find()->where(['kat'=>0])->all(), 'id', 'nama'))?>
              </div>
						
						
							<div class='col-xs-12'></div>
							
						

					</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               <?= Html::submitButton('Order', ['class' => 'btn btn-success']) ?>
			       <?php ActiveForm::end(); ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->