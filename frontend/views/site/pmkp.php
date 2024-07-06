<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'PMKP';
?>

<section style='border-bottom:1px solid #eee; padding-bottom:25px; margin-bottom:30px;'>
	<center><h1>PMKP</h1><br>PENINGKATAN MUTU KESELAMATAN PASIEN</center>
</section>
<div class='container' style='margin-bottom:200px;'>
	<div class='row'>
	<?php foreach($doc as $d): ?>
		<div class='col-md-12'>
			<h4><?= $d->Judul?></h4>
			<p><?=  date('d F Y',strtotime($d->PublishDate))?></p><br>
			<p><a href='<?= Url::to(['perpustakaan/dokumen/'.$d->Id])?>'>Lihat </a></p>
			<hr>
		</div>
	<?php endforeach; ?>
	</div>
</div>