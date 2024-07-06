<?php 
use yii\helpers\Html;
use common\models\Rawat;

$rawat = Rawat::find()->where(['idp'=>3])->andwhere(['ket'=>'pasien dari igd'])->andwhere(['between','waktudikirim','2019-08-01 00:00:00','2019-12-14 11:40:31'])->groupby(['rm'])->orderby(['waktudikirim'=>SORT_ASC])->all();
$no=1;
?>


<div  class="trx" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
	
<div class='judul-kunjungan'>
	<table>
	<tr>
	<td>No  </td>
	<td>No rm </td>
	<td>Nama Pasien </td>
	<td>Waktu dikirim </td>
	</tr>
	<?php foreach($rawat as $r):?>
	
	<tr>
		<td><?= $no++ ?></td>
		<td><?= $r->rm ?></td>
		<td><?= $r->pasien->nama_pasien ?></td>
		<td><?= $r->waktudikirim ?></td>
	</tr>
	<?php endforeach; ?>
</table>
			
		
			
	</div>
</div>
