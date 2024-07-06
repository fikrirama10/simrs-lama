<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\pasiens\Rawatjalan;
use yii\widgets\DetailView;
use yii\helpers\Url;
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$time = date('H:i:s');
/* @var $this yii\web\View */
/* @var $pasien common\pasiens\Pasisen */

$this->title = $pasien->no_rekmed;
$this->params['breadcrumbs'][] = ['label' => 'Pasisens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasisen-view" style='margin-top:30px;'>

	<div class="rawatjalan-form">
		<div class='container-fluid'>
			<div class='box box-info'>
				<div class='box box-header'>
					<h3>Detail Pasien</h3>
					
				</div>
				<div class='box box-body'>
					<div class='row'>
						<div class='col-xs-8'>
							<a class='nama_pasien'><?= $pasien->sbb ?>. <?= $pasien->nama_pasien ?></a> <a class='jenis_kelamin'>( <?= $pasien->jenis_kelamin ?> )</a> , <a class='jenis_kelamin'>( <?= $pasien->idStatus->status_hub ?> )</a> , 
						</div>
						<div class='col-xs-4 cs'>
							
							<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($pasien->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?>
						</div>
						
						<div class='col-md-12 bt10' >
						RM : <a style='padding-right:20px;'><?= $pasien->no_rekmed ?></a>   No Identitas :<a style='padding-right:20px;'> <?= $pasien->no_identitas ?>	</a></a>   Tanggal Daftar :<a> <?= $pasien->created_at ?>	</a>
						</div>		
					</div>
					<div class='row'>
						<div class='col-md-4 gol_darah'>
							<b style='font-size:15px;'><?= $pasien->tempat_lahir?>, <?= date('d F Y',strtotime($pasien->tanggal_lahir)) ?> ( <?= $pasien->usia?> Th )</b><br>
						
						</div>
						<div class='col-md-6'>
							<div class='row'>
								<div class='col-xs-12' style='border:1px solid #eee;'>
									<h4>Form <?= $model->jerawat->jenisrawat?></h4>
									<?php if($model->carabayar->id >= 3){ ?>
									<h5><span class="label label-primary"><?= $model->carabayar->jenisbayar ?></span></h5>
									<?php }else{ ?>
									<h5><span class="label label-success"><?= $model->carabayar->jenisbayar ?></span></h5>
									<?php }?>
								</div>
								<div class='col-md-6' style='border:1px solid #eee; padding:10px 0px 10px 15px;'>
									No Registrasi : <?= $model->idrawat?>
								</div>
								<?php if($model->idjenisrawat == 1){ ?>
								<div class='col-md-6' style='border:1px solid #eee; padding:10px 0px 10px 15px;'>
									Poli yang dituju : <?= $model->polii->namapoli?>
								</div>
								<div class='col-md-6' style='border:1px solid #eee; padding:10px 0px 10px 15px;'>
								Dokter : <?= $model->dokter->namadokter?>	
								</div>
								
								<?php }else if($model->idjenisrawat == 2){?>
								<div class='col-md-6' style='border:1px solid #eee; padding:10px 0px 10px 15px;'>
									Kelas Perawatan : <?= $model->kelas->namakelas?>
								</div>
								<div class='col-md-6' style='border:1px solid #eee; padding:10px 0px 10px 15px;'>
								Dokter : <?= $model->dokter->namadokter?>	
								</div>
								
								<?php } else if($model->idjenisrawat == 3){echo"";} ?>
								
								
								<div class='col-md-6' style='border:1px solid #eee; padding:10px 0px 10px 15px;'>
									Daftar : <?= date('d F Y / H:i:s',strtotime($model->tgldaftar)) ?>
								</div>
								<div class='col-md-12'>
										<div class='col-xs-1' style='padding-top:30px; padding-bottom:30px; padding-left:30px;'><a class='btn btn-primary' href='<?= Yii::$app->params['baseUrl'].'/dashboard/'?>'>Selesai</a></div>
								</div>
							</div>
						</div>
						<div class='col-md-2'>
						<?= Html::a('Print Label', ['label', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm pt-10','target' => '_blank']) ?>
						<?= Html::a('Print Form', ['fp', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm pt-10','target' => '_parent','inline'=>true]) ?>
						<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-default btn-sm pt-10']) ?>
						<?= Html::a('Input Sep', ['insep', 'id' => $model->id], ['class' => 'btn btn-success btn-sm pt-10']) ?>
						<?= Html::a('Delete', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger btn-sm pt-10','target' => '_blank','data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
												'data-method' => 'post',]) ?>
						<?php if($model->idbayar == 5){ ?>
						<br><a class='btn btn-success  btn-sm  pt-10' href='<?= Url::to(['/csep/create/'.$model->pasien->id])?>'>Buat SEP</a>
						<?php }else{echo"";}?>
						<br>
						
						</div>			
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    

</div>
