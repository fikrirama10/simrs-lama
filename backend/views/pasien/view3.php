<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\date\DatePicker;
use common\models\Jenisbayar;
use common\models\Dokter;
use yii\helpers\ArrayHelper;
use common\models\Poli;
use common\models\Orderlab;
use common\models\Klpcm;
use common\models\Radiologi;
use common\models\PemeriksaanRajal;
use common\models\PemeriksaanIgd;
use common\models\Radiologidetail;
use common\models\Lab;
use yii\web\View;
use common\models\Rawatjalan;
use common\models\Rekamedis;
use yii\widgets\DetailView;
use yii\helpers\Url;
use Picqer\Barcode\BarcodeGeneratorHTML;
$pass = Yii::$app->user->identity->password_repeat;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$time = date('H:i:s');
$hrj = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->andwhere(['idjenisrawat'=> 1])->count();
$hri = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->andwhere(['idjenisrawat'=> 2])->count();
$igd = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->andwhere(['idjenisrawat'=> 3])->count();
$labc = Orderlab::find()->where(['no_rekmed'=> $model->no_rekmed])->count();
$raddc = Radiologi::find()->where(['no_rekmed'=> $model->no_rekmed])->count();
$rawat = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->orderby(['tgldaftar'=>SORT_DESC])->all();
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */

//$this->title = $model->no_rekmed;
$this->params['breadcrumbs'][] = ['label' => 'Pasisens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pasisen-view">
<?php // \inquid\signature\SignatureWidget::widget(['clear' => true,'save_png'=>true, 'undo' => true, 'change_color' => true, 'url' => 'test', 'save_server' => true]) ?>
    <h1><?= Html::encode($this->title) ?>
	
	</h1>
	<div class="rawatjalan-form">
		<div class='container-fluid'>
			<div class='box box-info'>
				<div class='box box-header'>
					<h3>Detail Pasien</h3>
					
				</div>
				<div class='box box-body'>
				
				</div>
				<div class='box box-body'>
					<div class='row'>
						<div class='col-xs-8'>
							<a class='nama_pasien'><?= $model->sbb ?>. <?= $model->nama_pasien ?></a> <a class='jenis_kelamin'>( <?= $model->jenis_kelamin ?> )</a> , <a class='jenis_kelamin'>( <?= $model->idStatus->status_hub ?> )</a> , 
						</div>
						<div class='col-xs-4 cs'>
							
							<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?>
						</div>
						
						<div class='col-md-12 bt10' >
						RM : <a style='padding-right:20px;'><?= $model->no_rekmed ?></a>   No bPJS :<a style='padding-right:20px;'> <?= $model->nobpjs ?>	</a></a>   Tanggal Daftar :<a> <?= $model->created_at ?>	</a>
						</div>		
					</div>
					<div class='row'>
						<div class='col-md-3 gol_darah'>
							<b style='font-size:15px;'><?= $model->tempat_lahir?>, <?= date('d/m/Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th )</b><br>
							
							<?= $model->alamat ?>,
							<?php if($model->idkel == null && $model->idkel == null && $model->idkel == null){echo "";}else{ ?>
							<?= $model->kel->nama ?> , <?= $model->kec->nama ?> , <?= $model->kab->nama ?>
							<?php } ?>
						</div>
						<div class='col-md-9'>
				  <!-- Custom Tabs (Pulled to the right) -->
				  <div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
					  <li class="active"><a href="#tab_1-1" data-toggle="tab"><h4><span class="label label-warning">
  Rawatjalan <span class="badge badge-light"><?= $hrj ?></span>
</span></h4> </a></li>
					  <li><a href="#tab_2-2" data-toggle="tab"><h4><span class="label label-danger">
  UGD <span class="badge badge-light"><?= $igd ?></span>
</span></h4></a></li>
					  <li><a href="#tab_3-2" data-toggle="tab"><h4><span class="label label-info">
  Rawat Inap <span class="badge badge-light"><?= $hri ?></span>
</span></h4></a></li>
<li><a href="#tab_4-2" data-toggle="tab"><h4><span class="label label-default">
  Lab <span class="badge badge-light"><?= $labc ?></span>
</span></h4></a></li>
<li><a href="#tab_5-2" data-toggle="tab"><h4><span class="label label-default">
  Radiologi <span class="badge badge-light"><?= $raddc ?></span>
</span></h4></a></li>
					  <li class="pull-left header"><i class="fa fa-th"></i> </li>
					</ul>
					<div class="tab-content">
					  <div class="tab-pane active" id="tab_1-1">
					  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-obat">
              +
              </button><h4>Rawat Jalan</h4>
					  <table class="table table-striped">
						<tr>
						  <th>No</th>
						  <th>No Rwt</th>
						  <th>Dokumen</th>
						  <th>Poli</th>
						  <th>Jenis Bayar</th>
						  <th>Tanggal Masuk</th>
						  <th>Status</th>
						  <th>#</th>
						</tr>
						<?php $rajal = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->andwhere(['idjenisrawat'=>1])->orderby(['tgldaftar'=>SORT_DESC])->all();
						$no=1;
						if(count($rajal) > 0){
						foreach($rajal as $rj):
						$pemrajal = PemeriksaanRajal::find()->where(['idrawat'=>$rj->id])->one();
						
						?>
						<?php if(date('Y-m-d') == date('Y-m-d',strtotime($rj->tgldaftar))){?>
						
						<tr class='bg-info'>
						<?php }else{echo'<tr>';}?>
							<td><?= $no++ ?></td>
							<td> <h5><a class="label label-primary" data-toggle="collapse" href="#collapseExample<?= $rj->id?>" role="button" aria-expanded="false" aria-controls="collapseExample"><?= $rj->idrawat?></a></h5>
						<div class="collapse" id="collapseExample<?= $rj->id?>">
						  <div class="card card-body">
							<a href='#' id="btlabel<?= $rj->id?>"><span class="badge badge-light">Print Label</span></a>
							<a href='#'  id="btform<?= $rj->id?>" ><span class="badge badge-success">Print Form</span></a>
							<a  href='#' href='<?= Url::to(['rawatjalan/'.$rj->id]) ?>'target="_blank"><span class="badge badge-success">Lihat</span></a>
						  </div>
						</div></td>
						<iframe src="<?= Url::to(['rawatjalan/label/'.$rj->id]) ?>" style="border:none; display:none;" id='myFrameLabel<?= $rj->id?>' title="Iframe Example">
						
						</iframe>
						<iframe src="<?= Url::to(['rawatjalan/fp/'.$rj->id]) ?>" style="border:none; display:none;" id='myFrameForm<?= $rj->id?>' title="Iframe Example">
						
						</iframe>
						<?php
						$this->registerJs("

						$('#btlabel{$rj->id}').on('click',function(){
						let objFra = document.getElementById('myFrameLabel{$rj->id}');
						objFra.contentWindow.focus();
						objFra.contentWindow.print();
						});
						
						$('#btform{$rj->id}').on('click',function(){
						let objFra = document.getElementById('myFrameForm{$rj->id}');
						objFra.contentWindow.focus();
						objFra.contentWindow.print();
						});

						", View::POS_READY);
						?>
						<td>
							<?php $klpcm = Klpcm::find()->where(['idrajal'=>$rj->id])->one(); 
							$klpcmc = Klpcm::find()->where(['idrajal'=>$rj->id])->count(); 
							?>
							<?php if($klpcmc > 0){ ?>
								<a href='#' data-toggle="modal" data-target="#exampleModalLong-<?= $klpcm->id?>"><?= $klpcm->dokumen?></a></td>
									<div id="exampleModalLong-<?= $klpcm->id?>" class="modal fade bd-example-modal-lg<?= $klpcm->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-body">
										<div class='row'>
											<div class="modal-body">
										
											<div class="PDF">
											   <object data="<?= Yii::$app->params['baseUrl'].'/frontend/upload/documents/'.$klpcm->dokumen;?>" type="application/pdf" width="750" height="750">
												   alt : <a href="<?= Yii::$app->params['baseUrl'].'/frontend/upload/documents/'.$klpcm->dokumen;?>"><?= $klpcm->dokumen;?></a>
											   </object>
											</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>			
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
							<?php } ?>
						<td><?php if($rj->idpoli == null){echo'';}else{?>
							<?= $rj->polii->namapoli?>
							<?php } ?></td>
							<td><?= date('d/m/Y',strtotime($rj->tgldaftar))?></td>
							<td><?php if($rj->idkb == null){echo'';}else if($rj->idkb == 1){ ?>
							<span class="label label-success">Berobat Baru</span>
							<?php }else{echo'<span class="label label-warning">Kunjungan ulang</span>';} ?></td>
							
							<?php if($rj->batal == 1){ ?>
							<td>Batal Berobat</td>
							<?php }else{ ?>
							<?php if($pemrajal){ ?>
							<td><?= $pemrajal->statuspasien ?></td>
							<?php }else{ ?>
							<td>Belum ada pemeriksaan</td>
							<?php } ?>
							<?php } ?>
													<td>
							<a href='<?= Url::to(['rawatjalan/batalberobat/'.$rj->id]) ?>' title='Batal Berobat' ><span class="label label-warning"><span class="fa fa-user-times"></span></span></a>
							<a href='<?= Url::to(['rawatjalan/update/'.$rj->id]) ?>' title='Update' id='confirm' ><span class="label label-success"><span class="fa fa-pencil"></span></span></a>
							</td> 
						</tr>
						<?php endforeach; ?>
						<?php }else{ ?>
						<tr>
						<td colspan=7><div class="empty">No result found.</div></td>
						</tr>
						<?php } ?>
						

					  </table>
						
					  </div>
					  <!-- /.tab-pane -->
					  <div class="tab-pane " id="tab_2-2">
					   <a class='btn btn-danger' href='<?= Url::to(['pasien/igd/'.$model->id]) ?>'>+</a>
					  <h4>Unit Gawat Darurat</h4>
						<table class="table table-hover table-responsive-sm">
						<tr>
						  <th>No</th>
						  <th>No Rwt</th>
						  <th>Jenis Bayar</th>
						  <th>Tanggal Masuk</th>
						  <th>Status</th>
						  <th>Keadaan Pasien</th>
						  <th>#</th>
						</tr>
						<?php $rajal = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->andwhere(['idjenisrawat'=>3])->orderby(['tgldaftar'=>SORT_DESC])->all();
						
						$no=1;
						if(count($rajal) > 0){
						foreach($rajal as $rj):
						$pemugd = PemeriksaanIgd::find()->where(['idrawat'=>$rj->id])->one();
						?>
						
						<?php if(date('Y-m-d') == date('Y-m-d',strtotime($rj->tgldaftar))){?>
						<tr class='bg-info'>
						<?php }else{echo'<tr>';}?>
							<td><?= $no++ ?></td>
							<td> <h5><a class="label label-primary" data-toggle="collapse" href="#collapseExample<?= $rj->id?>" role="button" aria-expanded="false" aria-controls="collapseExample"><?= $rj->idrawat?></a></h5>
						<div class="collapse" id="collapseExample<?= $rj->id?>">
						  <div class="card card-body">
						<a href='<?= Url::to(['rawatjalan/label/'.$rj->id]) ?>' target="_blank"= ><span class="badge badge-light">Print Label</span></a>
							<a href='<?= Url::to(['rawatjalan/fp/'.$rj->id]) ?>'target="_blank"><span class="badge badge-success">Print Form</span></a>
							<a href='<?= Url::to(['rawatjalan/'.$rj->id]) ?>'target="_blank"><span class="badge badge-success">Lihat</span></a>
						  </div>
						</div></td>
							<td> <?= $rj->carabayar->jenisbayar ?> </td>
							<td><?= date('d/m/Y',strtotime($rj->tgldaftar))?></td>
							<td><?php if($rj->idkb == null){echo'';}else if($rj->idkb == 1){ ?>
							<span class="label label-success">Berobat Baru</span>
							<?php }else{echo'<span class="label label-warning">Kunjungan ulang</span>';} ?></td>
							<?php if($rj->batal == 1){ ?>
							<td>Batal Berobat</td>
							<?php }else{ ?>
							<?php if($pemugd){ ?>
							<td><?= $pemugd->statuspasien ?></td>
							<?php }else{ ?>
							<td>Belum ada pemeriksaan</td>
							<?php } ?>
							<?php } ?>
							<td>
							<a href='<?= Url::to(['rawatjalan/batalberobat/'.$rj->id]) ?>' title='Batal Berobat' ><span class="label label-warning"><span class="fa fa-user-times"></span></span></a>
							<a href='<?= Url::to(['pasien/kontroligd/'.$model->id]) ?>' title='Kontrol' ><span class="label label-info"><span class="fa fa-file-text"></span></span></a>
							<a href='<?= Url::to(['rawatjalan/update/'.$rj->id]) ?>' title='Update' id='confirm' ><span class="label label-success"><span class="fa fa-pencil"></span></span></a>
							</td> 
						</tr>
						<?php endforeach; ?>
						<?php }else{ ?>
						<tr>
						<td colspan=6><div class="empty">No result found.</div></td>
						</tr>
						<?php } ?>

					  </table>
						
						
						 
					  </div>
					  <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
			  <h4>Rawat Inap</h4>
              <table class="table table-striped">
						<tr>
						  <th>No</th>
						  <th>No Rwt</th>
						  <th>Jenis Bayar</th>
						  <th>Tanggal Masuk</th>
						  <th>Tanggal Pulang</th>
						  <th>Ruangan</th>
						  <th>#</th>
						</tr>
						<?php $rajal = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->andwhere(['idjenisrawat'=>2])->orderby(['tgldaftar'=>SORT_DESC])->all();
						$no=1;
						if(count($rajal) > 0){
						foreach($rajal as $rj):
						?>
						
						<tr>
							<td><?= $no++ ?></td>
							<td><h5><a class="label label-primary" data-toggle="collapse" href="#collapseExample<?= $rj->id?>" role="button" aria-expanded="false" aria-controls="collapseExample"><?= $rj->idrawat?></a></h5>
								<div class="collapse" id="collapseExample<?= $rj->id?>">
								<div class="card card-body">
								<a href='<?= Url::to(['rawatjalan/label/'.$rj->id]) ?>' target="_blank"= ><span class="badge badge-light">Print Label</span></a>
								<a href='<?= Url::to(['rawatjalan/fp/'.$rj->id]) ?>'target="_blank"><span class="badge badge-success">Print Form</span></a>
								<a href='<?= Url::to(['rawatjalan/'.$rj->id]) ?>'target="_blank"><span class="badge badge-success">Lihat</span></a>
								</div>
								</div>
							</td>
							<td><?= $rj->carabayar->jenisbayar ?></td>
							<td><?= date('Y/m/d',strtotime($rj->tglmasuk)) ?></td>
							<td>
								<?php if($rj->tglkeluar == null){echo'Belum Keluar';}else{ ?>
								<?= date('Y/m/d',strtotime($rj->tglkeluar)) ?>
								<?php } ?>
							</td>
							<?php if($rj->idruangan == null){
							    echo '<td></td>';
							 }else{  ?>
							<td><?= $rj->kamar->namaruangan ?></td>
							<?php } ?>
							<td>					
							<a href='<?= Url::to(['rawatjalan/batalberobat/'.$rj->id]) ?>' title='Kontrol' ><span class="label label-warning"><span class="fa fa-file-text"></span></span></a>
							<a href='<?= Url::to(['rawatjalan/update/'.$rj->id]) ?>' title='Update' ><span class="label label-success"><span class="fa fa-pencil"></span></span></a>
							</td> 
						</tr>
						
						<?php endforeach; ?>
						<?php }else{ ?>
						<tr>
						<td colspan=7><div class="empty">No result found.</div></td>
						</tr>
						<?php } ?>

					  </table>
				 
				 
              </div>
              <!-- /.tab-pane -->
			  <div class="tab-pane" id="tab_4-2">
			  <h4>Lab</h4>
              	<table class="table table-striped">
						<tr>
						  <th>No</th>
						  <th>No Lab</th>
						  <th>Jam Periksa</th>
						  <th>Tanggal Periksa</th>
						  <th>Jenis Rawat</th>
						  <th>Pemeriksaan</th>
						  <th>#</th>
						</tr>
						<?php $lab = Orderlab::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
						$no=1;
						if(count($lab) > 0){
						foreach($lab as $lb):
						?>
						<?php $labs= Lab::find()->where(['kodelab'=>$lb->kodelab])->all(); ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><a class="label label-success"><?= $lb->kodelab ?></a></td>
							<td><?= date('G:i A',strtotime($lb->tgl_order)) ?></td>
							<td><?= date('d/m/Y',strtotime($lb->tgl_order)) ?></td>
						
							<td><?php foreach($labs as $llb): ?>
								<?php if($llb->idkatjenisp == null){echo'Pemeriksaan kosong harap edit / hapus';}else{ ?>
									<?= $llb->katlab->nama?>,<?php } ?>
								<?php endforeach;?>
							</td>
							<td><a href='<?= Url::to(['/orderlab/printlab/'.$lb->id]) ?>'target="_blank" ><span class="label label-primary"><span class="fa fa-print"></span></span></a></td>
						</tr>
						
						<?php endforeach; ?>
						<?php }else{ ?>
						<tr>
						<td colspan=7><div class="empty">No result found.</div></td>
						</tr>
						<?php } ?>

					  </table>
				 
				 
              </div>
			  <div class="tab-pane" id="tab_5-2">
			  <h4>Radiologi</h4>
              	<table class="table table-striped">
						<tr>
						  <th>No</th>
						  <th>No Rad</th>
						  <th>Tanggal Periksa</th>
						  <th>Pemeriksaan</th>
						  <th>#</th>
						</tr>
						<?php $rad = Radiologi::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
						$no=1;
						if(count($rad) > 0){
						foreach($rad as $rd):
						?>
						<?php $rads = Radiologidetail::find()->where(['idrad'=>$rd->idrad])->all(); ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $rd->idrad ?></td>
							<td><?= $rd->tanggal ?></td>
							<td>
							<?php foreach($rads as $rs): ?>							
							<?php if($rs->idjenisrad == null){echo'Pemeriksaan kosong harap edit / hapus';}else{ ?>
									<?= $rs->drad->jenispemeriksaan ?>,<?php } ?>
									<a href='<?= Url::to(['/radiologi/printrad/'.$rs->id]) ?>'target="_blank" ><span class="label label-primary"><span class="fa fa-print"></span></span></a>
								<?php endforeach;?></td>
							<td></td>
							
						</tr>
						
						<?php endforeach; ?>
						<?php }else{ ?>
						<tr>
						<td colspan=7><div class="empty">No result found.</div></td>
						</tr>
						<?php } ?>

					  </table>
				 
				 
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
		 
          <!-- nav-tabs-custom -->

						</div>
						</div>
						<div class='row'>
						
						<div class='col-md-12'>
						
						</div>
						</div>
					</div>
				</div>
				
		</div>
	</div>
	<div class="modal fade" id="modal-obat">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Rawatjalan</h4>
              </div>
    <div class="modal-body">
	<div class = "container-fluid">
		  <div class='row'>
		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($rawatjalan, 'no_rekmed')->textInput(['value'=>$model->no_rekmed]) ?>
		<?= $form->field($lograwat, 'rm')->hiddeninput(['value'=>$model->no_rekmed])->label(false) ?>
		<div class='form-group'>
				<label> Poliklinik </label>
				<select id="pasien-poli" name='Rawatjalan[idkb]' class="form-control" required aria-invalid="false">
					<option value="">-Pilih Kunjungan-</option>
					
					<option value="1">Berobat Baru</option>
					<option value="2">Kontrol</option>
					
				</select>
			</div>
		<div class='row'>
			<div class='col-md-9'>
			<?php if($model->jenis_kelamin == 'L'){ ?>
		<?php if($model->usia <=17){ ?>
		<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['between','id',1,4])->andwhere(['anak'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
		{
		$( "select#rawatjalan-iddokter" ).html( data );
		});

		'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
		<?php }else{ ?>
		<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['between','id',1,4])->andwhere(['dewasa'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
		{
		$( "select#rawatjalan-iddokter" ).html( data );
		});

		'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
		<?php } ?>
		<?php }else{ ?>
		<?php if($model->usia <=17){ ?>
		<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['anak'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
		{
		$( "select#rawatjalan-iddokter" ).html( data );
		});

		'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
		<?php }else{ ?>
		<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['dewasa'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
		{
		$( "select#rawatjalan-iddokter" ).html( data );
		});

		'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
		<?php } ?>
		<?php } ?>
			</div>
			<div class='col-md-3'>
			<label></label>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" name="Rawatjalan[anggota]"  class="custom-control-input" id="anggota" value="1" >
					<label class="custom-control-label" for="customCheck1">Anggota</label>
				</div>
			</div>
		</div>
		

		<?= $form->field($rawatjalan, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->where(['id'=>0])->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label()?>
		<?=	$form->field($rawatjalan, 'tgldaftar')->widget(DatePicker::classname(),[
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'pluginOptions' => [
		'autoclose'=>true,
		'format' => 'yyyy-mm-dd',
		'todayHighlight' => true,
		]
		])->label('Jadwal Berobat');?>
		<?= $form->field($rawatjalan, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -'])->label('',['class'=>'label-class'])->label()?>
		<?= $form->field($rawatjalan, 'ketrj')->textarea(['rows'=>6])->label("Keterangan") ?>
		
		
		
		<?=$form->field($rawatjalan, 'rencranap', [
		'template' => '{input}{label}{error}{hint}',
		'labelOptions' => ['class' => 'cbx-label']
		])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Rawat  ?'); 
		?> 
								
								
								
							</div>
	</div>
             
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success','id'=>'confirm']) ?>
				<?php ActiveForm::end(); ?>
              </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<div class="modal fade" id="modal-igd">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">UGD</h4>
              </div>
    <div class="modal-body">
	<div class = "container-fluid">
		  <div class='row'>
					
								
							</div>
	</div>
             
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<?php 

$this->registerJs("

$('#confirm').on('click', function(event){
	age =  prompt('Masukan Kode Verifikasi?', );
	if(age == '{$pass}'){
       return true;
    } else {
        event.preventDefault();
        alert('Password salah');
    }
});

", View::POS_READY);
?>