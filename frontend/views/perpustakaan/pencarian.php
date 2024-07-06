<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
$this->title = 'Pencarian Dokumen';

?>
<section  class="medilife-blog-area section-padding-100">
        <div class="container">
		<h3><?= Html::encode($this->title);?></h3>
		<div class='row'>
			<div class='col-sm-12'>
								
				<?php if(empty($docs)):?>
					<div class='alert alert-warning'>
						Hasil pencarian dokumen dengan kata kunci <b><?php echo $_GET['keyword'];?></b> tidak ditemukan
					</div>
					
				<?php else:?>
					<div class='alert alert-success'>
						Hasil pencarian dokumen dengan kata kunci <b><?php echo $_GET['keyword'];?></b> ditemukan <?php echo count($docs);?> Dokumen
					</div>
					<?php foreach($docs as $model):?>
					<div class='col-md-12'>
						<div class='row'>
							
							<div class='col-md-12'>
							<a style='line-height:40px; font-size:20px;'><?= $model->Judul?></a><br>
							( <?= $model->kategori->Kategori ?> | <?= $model->jenis->Jenis ?>)<br>
							Dipublikasikan Oleh : <?= $model->UserId?><br>
							Tgl Dipublikasikan : <?= $model->PublishDate?><br>
							<a href='<?= Url::to(['perpustakaan/dokumen/'.$model->Id])?>' style='color:blue;'>Lihat >></a><hr>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<?php endif;?>
			</div>
			<div class='col-sm-4'>
				
			</div>
		</div>
	</div>
</section>