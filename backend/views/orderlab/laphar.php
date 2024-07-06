<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Orderlab;
use common\models\Lab;
use common\models\Subkattindakanlab;
$orlap = Orderlab::find()->where(['DATE_FORMAT(tgl_order,"%Y-%m-%d")'=>date('Y-m-d')])->all();
$no=1;
/* @var $this yii\web\View */
/* @var $model common\models\RekamedisSearch */
/* @var $form yii\widgets\ActiveForm */
?>
	<div class='box box-body'>
	<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Status Pasien</th>
			<th>Nama Pasien</th>
			<th>No RM</th>
			<th>Jenis Pemeriksaan</th>
		</tr>
	<?php foreach($orlap as $ol): ?>
		<?php $plab = Lab::find()->where(['kodelab'=>$ol->kodelab])->all(); ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $no++ ?></td>
			<td><?= $ol->pasien->nama_pasien ?></td>
			<td><?= $ol->no_rekmed ?></td>
			<td>
				<?php foreach($plab as $pb): ?>
					<?= $pb->katlab->nama?>,
				<?php endforeach; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	</div>
