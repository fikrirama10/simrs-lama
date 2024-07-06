<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<div class='paper a4-landscape'>
	<!-- header -->
	<div class='row'>
		<div class='inv-date pull-left'>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/resources/logo.png',['class'=>'img img-responsive a4-logo']) ?>
			
		</div>
		<div class='inv-logo pull-right'>
			<h4>Dokumen Informasi Publik</h4>
		</div>
	</div>
	<!-- eof header -->
	
	<div class='row'>
		<table class='inv-table'>
			<thead>
				<tr class='inv-tb-header'>
					<td><h6>KODE</h6></td>
					<td><h6>JUDUL</h6></td>
					<td><h6>JENIS</h6></td>
					<td><h6>KATEGORI</h6></td>
					<td><h6>TYPE</h6></td>
					<td><h6>PENERBIT</h6></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($details as $d):?>
				<tr class='inv-row'>
					<td><?= $d->Kode;?><br/><div class='inv-tb-timestamp'><?= Yii::$app->algo->tglIndoNoTime($d->PublishDate);?></div></td>
					<td><?= $d->Judul;?></td>
					<td><?= $d->kategori->Kategori;?></td>
					<td><?= $d->jenis->Jenis;?></td>
					<td><?= $d->type->Type;?></td>
					<td><?= $d->skpd->Institusi;?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				
			</tfoot>
		</table>
	</div>
	
</div>