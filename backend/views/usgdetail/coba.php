<?php
use yii\helpers\Html;
?>
<div class='headerrad'>
	<div class='logorad2'>
	<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/hitput.png',['class' => 'img img-responsive']);?>
	</div>
	<div class='unitrad2 '><b>UNIT RADIOLOGI <br> RSAU dr.NORMAN T.LUBIS</b></div>
	<div class='drtyh2'><p class='ke	pada'>Kepada</p><p class='yth'>Yth 
	<?php if($pemriklab->stpasien == 'RS'){echo $pemriklab->dokter;}else{echo $pemriklab->dl;} ?>
	</p><p class='kepada'>Ditempat</p></div>
	

</div>

<div class='orad'>
	<table>
		<tr>
			<td>No RM</td>
			<td>:</td>
			<td><?= $pemriklab->no_rekmed ?></td>
			<td></td>
			<td>No Foto</td>
			<td>:</td>
			<td><?= $rawatjalan->nousg?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td>
			<?php if($pemriklab->stpasien == 'RS'){ ?>
			<?= $pemriklab->pasien->sbb ?><?php }else{ ?>.<?= $pemriklab->nama ?> <?php } ?></td>
			<td></td>
			<td>Pemeriksaan</td>
			<td>:</td>
			<td><?= $rawatjalan->pemeriksaan->namausg ?></td>
		</tr>
		<tr>
			<td>Tgl Lahir</td>
			<td>:</td>
			<td>
			<?php if($pemriklab->stpasien == 'RS'){ ?>
				<?= date('d-m-Y',strtotime($pemriklab->pasien->tanggal_lahir)) ?> / <?= $pemriklab->usia ?> th<?php }else{ ?><?= $pemriklab->usia ?> th<?php } ?></td>
		</td>
			<td></td>
			<td>Alamat</td>
			<td>:</td>
			<td><?= $pemriklab->alamat?></td>
		</tr>
		<tr>
			<td>Tgl Pemeriksaan</td>
			<td>:</td>
			<td><?= date('Y-m-d',strtotime($pemriklab->tglusg)) ?></td>
		</tr>
	</table>
</div>	

<b>Klinis</b><br>
<div style='width:100%; float:left; min-height:100px; overflow:hidden; padding-left:10px; padding-top:10px; padding-bottom:10px; border:1px solid;'>
	
	<?= $rawatjalan->klinis ?>
</div>	

<b>Hasil</b>
<div style='width:100%; text-align:justify; float:left; min-height:100px; overflow:hidden; padding-left:10px; padding-right:10px; padding-top:10px; padding-bottom:10px; border:1px solid;'>
	
	<?= nl2br (stripslashes ($rawatjalan->hasil))?>
</div>	
<b>Kesimpulan</b>
<div style='width:100%; float:left;text-align:justify;  min-height:100px; overflow:hidden; margin-top:0px; padding-right:10px; padding-left:10px; padding-top:10px; padding-bottom:10px; border:1px solid;'>
	<?= nl2br (stripslashes ($rawatjalan->kesimpulan))?>
</div>	
<div style='width:30%; float:right; margin-top:20px; text-align:center; '>
Yang Memeriksa<br>Dokter Unit Radiologi
<br>
	<br>
	<br>
	<br>
	<?php // Html::img(Yii::$app->params['baseUrl'].'/frontend/images/drdevi.png',['class' => 'img img-responsive']);?>
	dr Deviasari Sp.Rad
</div>