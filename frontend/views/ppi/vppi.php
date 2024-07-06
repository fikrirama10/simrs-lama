<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class='row'>
        <div class='col-md-4'>
		<div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><?= $model->dokter->namadokter?></h3>
              <h5 class="widget-user-desc"><?= $model->dokter->spesialis?></h5>
            </div>
            <div class="widget-user-image">
             
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">3,200</h5>
                    <span class="description-text">Pasien</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">13,000</h5>
                    <span class="description-text">Diagnosa</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">3.500</h5>
                    <span class="description-text">pemeriksaan</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
		  
          <!-- /.widget-user -->
        </div>
		
        </div>
		<div class='col-md-6'>
			<div class='box box-primary'>
				<div class='box box-header'>
				<h5>Prosedur Pencegahan Infeksi ( PPI )</h5>
				</div>
				<div class='box box-body'>
				 <?php $form = ActiveForm::begin(); ?>
				 <?= $form->field($ppi, 'idpetu')->hiddeninput(['value'=>$model->iddokter])->label(false) ?>
				 <?= $form->field($ppi, 'idrawat')->hiddeninput(['value'=>$model->idrawat])->label(false) ?>
				 <?= $form->field($ppi, 'rm')->hiddeninput(['value'=>$model->no_rekmed])->label(false) ?>
				 <?= $form->field($ppi, 'idjenisrawat')->hiddeninput(['value'=>$model->idjenisrawat])->label(false) ?>
				<?=$form->field($ppi, 'cucirtsbelum')->radioList([
					'Y' => 'Ya', 
					'N' => 'Tidak'
				],['class' => 'flat-red'])->label("Cuci Tangan Sebelum Periksa Pasien"); ?>
				<?=$form->field($ppi, 'cucitssudah')->radioList([
					'Y' => 'Ya', 
					'N' => 'Tidak'
				],['class' => 'flat-red'])->label("Cuci Tangan Sesudah Periksa Pasien"); ?>
				 <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-block']) ?>
				<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
  </div>
			