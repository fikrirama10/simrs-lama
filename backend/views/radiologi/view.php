<?php
use common\models\Radiologidetail;
use common\models\Pemriklab;
use common\models\Idlab;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\Subkattindakanlab;
use common\models\Kattindakanlab;
use yii\helpers\Url;
$rad = Radiologidetail::find()->where(['idrad'=>$model->idrad])->all();
?>

<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-12'>
		
			<div class='box box-body'>
				<div class='row'>
					<div class='col-md-12'>
					<a href='<?= Url::to(['radiologi/printrad2/'.$model->id]) ?>'><span class="label label-success">Print All</span></a>
					</div>
					<div class='col-md-12'>
						<h4>List Periksa Radiologi</h4>
					<table class="table table-bordered">
						<tr>	
							
							<th>Jenis Pemeriksaan</th>
							<th>Tanggal</th>
							<th>Jam Request</th>
							<th>Pemeriksa</th>
							<th>#</th>
						</tr>
					<?php foreach($rad as $l): ?>
					<tr>
						<td><?= $l->drad->jenispemeriksaan?></td>
						<td><?= date('d F Y',strtotime($model->tanggal)) ?></td>
						<td><?=  date('G:i A',strtotime($model->tanggal))?></td>
						<?php if($l->idpemeriksa == 0){echo"<td></td>";}else{ ?>
						<td><?= $l->pemeriksa->username ?></td>
						<?php } ?>
						
					
						<?php if($l->status == 1){ ?>
					<td><a href='<?= Url::to(['radiologi/perikrad/'.$l->id]) ?>'><span class="label label-success">Edit</span></a>
						<a href='<?= Url::to(['radiologi/printrad/'.$l->id],['target' => '_blank']) ?>' target='_blank'><span class="label label-warning">Print</span></a>
						<a href='<?= Url::to(['radiologi/label/'.$l->id],['target' => '_blank']) ?>' target='_blank'><span class="label label-info">Print Label</span></a>
						</td>
						
						<?php }else{ ?>
						<td>
						    	<a href='<?= Url::to(['radiologi/label/'.$l->id],['target' => '_blank']) ?>' target='_blank'><span class="label label-info">Print Label</span></a>
						    <a href='<?= Url::to(['radiologi/perikrad/'.$l->id]) ?>'><span class="label label-success">Test</span></a></td>
						<?php } ?>
						
					</tr>
					<?php endforeach; ?>
				</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
