<?php
use common\models\Radiologidetail;
use common\models\Pemriklab;
use common\models\Idlab;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\Subkattindakanlab;
use common\models\Radmcu;
use yii\helpers\Url;
$rad = Radmcu::find()->where(['id'=>$model->id])->all();
?>

<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-12'>
		
			<div class='box box-body'>
				<div class='row'>
					<div class='col-md-12'>
					
					</div>
					<div class='col-md-12'>
						<h4>List Periksa Radiologi</h4><br>
						<h5><?= $model->nama?></h5>
						<h5><?= $model->alamat?></h5>
					<table class="table table-bordered">
						<tr>	
							
							<th>Jenis Pemeriksaan</th>
							<th>Tanggal</th>
							<th>Form</th>
							<th>Label</th>
						</tr>
					<?php foreach($rad as $l): ?>
					<tr>
						<td><?= $l->drad->jenispemeriksaan?></td>
						<td><?= date('d F Y',strtotime($model->tanggal)) ?></td>
						<td><?= Html::a('<span class="label label-warning"><i class="fa fa-print"></i> Form</span>', ['printmcu', 'id' => $model->id], ['target' => '_blank']) ?></td>
						<td><?= Html::a('<span class="label label-info"><i class="fa fa-print"></i> Label</span>', ['label-mcu', 'id' => $model->id], ['target' => '_blank']) ?></td>
						
					</tr>
					<?php endforeach; ?>
				</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
