<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
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
					<h5>Rawat Jalan</h5><hr>
					<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
					<div class='row'>
						<div  class='col-md-4'  style='text-align:right; line-height:40px;'>Spesialis</div>
						<div class='col-md-3'><?= $form->field($model, 'sp')->textinput(['placeholder' => 'kode atau nama spesialis','onkeyup'=>'$.get("'.Url::toRoute('tes/polii/').'",{ id: $(this).val() }).done(function( data ) 
									{
										  $( "select#spesialis-pasien" ).html( data );
										  });'])->label(false) ?></div>
					<div class='col-md-5'>
					<select id="spesialis-pasien" class="form-control" name='Csep[spesialis]' aria-invalid="false">	</select>
					</div>

					</div>
					<div class='row' id='popok'>
						<div  class='col-md-4'  style='text-align:right; line-height:40px;'>Ppk Asal Rujukan</div>
						<div class='col-md-8'><?= $form->field($model, 'sp')->textInput(['maxlength' => true,'placeholder'=> $kelas2[0]['nama'],'readonly'=>true])->label(false) ?></div>
					</div>
				
			
			
				
				<input type='hidden' id='coba' name='coba'>
					
					
										<div class='row'  id='tglrujuk'>
						<div class='col-md-4'style='text-align:right; line-height:40px;'>Tgl Rujukan</div>
						<div class='col-md-3'><?=	$form->field($model, 'tglRujukan')->widget(DatePicker::classname(),[
						'type' => DatePicker::TYPE_COMPONENT_APPEND,
						'pluginOptions' => [
						'autoclose'=>true,
						'format' => 'yyyy-mm-dd',
						'todayHighlight' => true,
						 'autoclose'=>true,
						'endDate' => "0d"
						]
						])->label(false);?>
						</div>
					</div>
					<div class='row' id='rujukan'>
						<div  class='col-md-4'  style='text-align:right; line-height:40px;'>No Rujukan</div>
						<div class='col-md-8'>
						<?= $form->field($model, 'norujukan')->textInput(['maxlength' => true])->label(false) ?>
						<?= $form->field($model, 'kelas')->hiddeninput(['maxlength' => true,'value'=>$kelas['hakKelas']['kode']])->label(false) ?>
						</div>
					</div>
						<div class='row'>
						<div  class='col-md-4'  style='text-align:right; line-height:40px;'>Tgl SEP</div>
						<div class='col-md-4'><?= $form->field($model, 'tglSEP',['addon' => ['prepend' => ['content'=>'<i class="fa fa-calendar"></i>']],])->textInput(['maxlength' => true,'value'=>$model->tglSEP,'readonly'=>true])->label(false) ?></div>
					</div>
				
	
					<div class='row'>
						<div  class='col-md-4'  style='text-align:right; line-height:40px;'>No Mr</div>
						<div class='col-md-3'><?php if($pasien == null){?>
					<?= $form->field($model, 'noMR',['addon' => ['prepend' => ['content'=>'<i class="fa fa-lock"></i>']],])->textInput(['maxlength' => true,'value'=>$kelas['mr']['noMR']])->label(false) ?>
					<?php }else{ ?>
					<?= $form->field($model, 'noMR')->textInput(['maxlength' => true,'value'=>$pasien->no_rekmed])->label(false) ?>
					<?php } ?></div>
					</div>
					<div class='row' id='rujukan'>
						<div  class='col-md-4'  style='text-align:right; line-height:40px;'>No Telepon</div>
						<div class='col-md-8'><?= $form->field($model, 'noTlp')->textInput(['maxlength' => true])->label(false) ?></div>
					</div>
					
				<div class='row'>
					<div class='col-md-4'style='text-align:right; line-height:40px;'>Diagnosa</div>
					<div class='col-md-3'>
					 <?= $form->field($model, 'kdiag')->textinput(['placeholder' => 'KODE DIAGNOSA','onkeyup'=>'$.get("'.Url::toRoute('tes/listdiag/').'",{ id: $(this).val() }).done(function( data ) 
								{
									  $( "select#diagnosa-pasien" ).html( data );
									  });'])->label(false) ?>
					</div>
					<div class='col-md-5'>
					<select id="diagnosa-pasien" class="form-control" name='Csep[dignosa]' aria-invalid="false">
					</select>
					</div>
				</div>
				<div class='row' id='rujukan'>
						<div  class='col-md-4'  style='text-align:right; line-height:40px;'>Catatan</div>
						<div class='col-md-8'><?= $form->field($model, 'catatan')->textArea()->label(false) ?></div>
					</div>
				
					<div class="form-group">
						<?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
					</div>
					 <?php ActiveForm::end(); ?>
					<hr>
				</div>
			</div>
		</div>
   </div>

</div>
<?php 
$this->registerJs("
 $('#rujukan').addClass('disabel');
				 $('#tglrujuk').addClass('disabel');
				 $('#popok').addClass('disabel');
				 $('#dpjp').addClass('disabel');
		
				$('#spesialis-pasien').on('change',function() {
				
                var dob = $('#spesialis-pasien').val();
				$('#coba').val(dob);
				if(dob != 'IGD'){
				$('#rujukan').removeClass('disabel',false);
				$('#tglrujuk').removeClass('disabel',false);
				$('#popok').removeClass('disabel',false);
				$('#dpjp').removeClass('disabel',false);
				
				}else{
 $('#rujukan').addClass('disabel');
				 $('#tglrujuk').addClass('disabel');
				 $('#spri').addClass('disabel');
				 $('#dpjp').addClass('disabel');
				}
				});
        
	

", View::POS_READY);
?>

