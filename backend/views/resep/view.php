<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use common\models\Obat;
use common\models\Resepdokter;
use common\models\Trxapotek;
use common\models\Trxresep;
use yii\helpers\Url;
use yii\web\View;
$day = date('Y-m-d',strtotime('+7 hour',strtotime(date('Y-m-d H:i:s'))));
use kartik\date\DatePicker;
$resepd = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idtkp'=>$model->idjenisrawat])->all();
$trx = Trxapotek::find()->where(['idrawat'=>$model->id])->all();
$trx2 = Trxapotek::find()->where(['idrawat'=>$model->id])->count();


$no=1;
        $instArray = ArrayHelper::map(Obat::find()->where(['idjenisobat'=>$model->idbayar])->all(), 'id', 'namaobat');
?>
<div class='container-fluid'>
	<div class='box box-warning box-header'>
		<h3>Tulis Resep </h3>
	</div>
	<div class='box box-body'>
		<div class='row'>
			<div class='col-md-4'>
				<table class='table table-bordered'>
					<tr>
						<td>Nama Pasien</td>
						<td>:</td>
						<td><?= $model->pasien->nama_pasien?></td>
					</tr>
					<tr>
						<td>No RM</td>
						<td>:</td>
						<td><?= $model->no_rekmed?></td>
					</tr>
					<tr>
						<td>Usia</td>
						<td>:</td>
						<td><?= $model->usia?> th</td>
					</tr>
					<tr>
						<td>Jenis Rawat</td>
						<td>:</td>
						<td><?= $model->jerawat->jenisrawat?></td>
					</tr>
					<tr>
						<td>Jenis Bayar</td>
						<td>:</td>
						<td><?= $model->carabayar->jenisbayar?></td>
					</tr>
					
				</table>
				<?php if($model->idjenisrawat == 2){
				    echo  Html::a('Add Resep', ['detail', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm pt-10']);
				}else{ ?>
				    <?php if($trx2 == 0){ ?>
				        <?= Html::a('Add Resep', ['detail', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm pt-10']) ?>
				    <?php }else{echo'';} ?>
				<?php } ?>
			</div>
			<div class='col-md-8'>
			<table class='table table-bordered'>				
				<tr>
					<th>No Resep</th>
					<th>Tanggal Resep</th>
					<th>Total Harga</th>
					<th>#</th>
				</tr>
					
				<?php foreach($trx as $tr): 
					$trxd = Trxresep::find()->where(['trxid'=>$tr->idtrx])->all();
					$hari = date('Y-m-d',strtotime($tr->tgl));
				?>
				<tr>
					<td><?= $tr->idtrx?></td>
					<td><?= $tr->tgl?></td>
					<td><?= $tr->total?></td>
					<?php if($hari != date('Y-m-d')){ ?>
					<td><a href='<?= Yii::$app->params['baseUrl'].'/dashboard/resep/createresep/'.$tr->id?>' class='label label-primary'>Lihat</a></td>
					<?php }else{?>
					<td><a href='<?= Yii::$app->params['baseUrl'].'/dashboard/resep/createresep/'.$tr->id?>' class='label label-primary'>edit</a></td>
					<?php } ?>
					
				</tr>			
				<?php endforeach; ?>
			</table>	
			</div>
		</div>
		
	</div>

</div>