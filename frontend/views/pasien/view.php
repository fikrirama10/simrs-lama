<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Rawatjalan;
use yii\widgets\DetailView;
use yii\helpers\Url;
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$time = date('H:i:s');
$hrj = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->andwhere(['idjenisrawat'=> 1])->count();
$hri = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->andwhere(['idjenisrawat'=> 2])->count();
$igd = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->andwhere(['idjenisrawat'=> 3])->count();
$rawat = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->orderby(['tgldaftar'=>SORT_DESC])->all();
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */

//$this->title = $model->no_rekmed;
$this->params['breadcrumbs'][] = ['label' => 'Pasisens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasisen-view">
<?php // \inquid\signature\SignatureWidget::widget(['clear' => true,'save_png'=>true, 'undo' => true, 'change_color' => true, 'url' => 'test', 'save_server' => true]) ?>
    <h1><?= Html::encode($this->title) ?></h1>
	<div class="rawatjalan-form">
		<div class='container-fluid'>
			<div class='box box-info'>
				<div class='box box-header'>
					<h3>Detail Pasien</h3>
					
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
						RM : <a style='padding-right:20px;'><?= $model->no_rekmed ?></a>   No Identitas :<a style='padding-right:20px;'> <?= $model->no_identitas ?>	</a></a>   Tanggal Daftar :<a> <?= $model->created_at ?>	</a>
						</div>		
					</div>
					<div class='row'>
						<div class='col-md-4 gol_darah'>
							<b style='font-size:15px;'><?= $model->tempat_lahir?>, <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th )</b><br>
							
							<?= $model->alamat ?>,
							<?php if($model->idkel == null && $model->idkel == null && $model->idkel == null){echo "";}else{ ?>
							<?= $model->kel->nama ?> , <?= $model->kec->nama ?> , <?= $model->kab->nama ?>
							<?php } ?>
						</div>
						<div class='col-md-2' style=' text-align:center; padding-top:25px; border-right:1px solid #eee;'>
							<a style='font-size:40px;'><?= $hrj ?>x</a><br> <a class='btn btn-primary' href='<?= Url::to(['pasien/rawatjalan/'.$model->id]) ?>'>Rawat Jalan</a>
						</div>
						<div class='col-md-2' style=' text-align:center; padding-top:25px; border-right:1px solid #eee;'>
							<a style='font-size:40px;'><?= $hri ?>x</a><br> <a class='btn btn-warning' href='<?= Url::to(['pasien/rawatinap/'.$model->id]) ?>'>Rawat Inap</a>
						</div>
						<div class='col-md-2' style=' text-align:center; padding-top:25px; border-right:1px solid #eee;'>
							<a style='font-size:40px;'><?= $igd ?>x</a><br> <a class='btn btn-danger' href='<?= Url::to(['pasien/igd/'.$model->id]) ?>'>IGD</a>
						</div>
						<div class='col-md-2 iic' style=' text-align:center; padding-top:25px; border-right:1px solid #eee;'>
							<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/usia/baby.png',['class' => 'img img-responsive']);?>
						</div>
					</div>
					</div>
				</div>
				<div class='box box-danger'>
				<div class='box box-body'>
				<?= Html::a('Print Rekamedik', ['hdiagnosa', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm pt-10','target' => '_blank']) ?>
					<h3>Data Rekamedik</h3>
					<div class='row'>
						<?php foreach($rawat as $r):?>
						<div class='col-md-12'>
					
							<div class='box box-body'>
							<h3><?= date('d F Y',strtotime($r->tgldaftar)) ?></h3>
							<a style='color:grey;'><?= $r->no_rekmed ?> , <?= $r->idrawat?></a>
							<h6><?= $r->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($r->pasien->tanggal_lahir)) ?> ,<?=$r->pasien->usia?> th</h6>
							<a><?php if($r->idjenisrawat == 1){echo $r->jerawat->jenisrawat .' , '. $r->polii->namapoli;}
							else if($r->idjenisrawat == 2){echo $r->jerawat->jenisrawat .','. $r->idkelas;}else{echo $r->jerawat->jenisrawat;} 
							?></a>
							<?php if(Yii::$app->user->identity->idpriv <= 4){ ?>
							<a class='btn btn-primary pull-right' href='<?= Url::to(['rawatjalan/'.$r->id]) ?>' >Lihat</a>
							<?php }else{echo'-';} ?>
						</div>
						
						</div>
						<?php endforeach; ?>
					
				</div>
				
				</div>
			</div>
		</div>
	</div>
    

</div>
