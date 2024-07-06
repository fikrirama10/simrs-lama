<?php
use common\models\Dokumen;
use yii\helpers\Html;
use yii\helpers\Url;
$dokumen = Dokumen::find()->where(['IdJenis'=>$model->IdJenis])->orderby(['IdJenis' => SORT_DESC])->limit(5)->all();
?>
<section  class="medilife-blog-area section-padding-100">
        <div class="container"style=''>
			<hr><br>
				<h5 style='' class='white'>Cari Informasi Disini</h5>
							<form role="search" action="/simrs/perpustakaan/pencarian" method="get">
							<div class="form-group">
								<input type="text" name='keyword' class="form-control form-outline-sm" placeholder="cari dokumen">
							</div>
							 
							</form>
			<div class='row'>
		
				<div class='col-md-8'>
					<div class="PDF">
					   <object data="<?= Yii::$app->params['baseUrl'].'/frontend/upload/documents/'.$model->FileName;?>" type="application/pdf" width="100%" height="700">
						   alt : <a href="<?= Yii::$app->params['baseUrl'].'/frontend/upload/documents/'.$model->FileName;?>"><?= $model->FileName;?></a>
					   </object>
					</div>
				</div>
				<div class='col-md-4'>
					<div class='row'>
						<div class='col-md-12'>
						
						</div>
					</div>
					<div class='row' style='border-bottom:1px solid #ececec; padding-bottom:10px;'>
						<div class='col-md-4' style='border:1px solid #ececec;'>
							<?= Html::a(Html::img(Yii::$app->request->baseUrl.'/frontend/images/book2.png',['class' => 'img  logo pull-righ img-responsive']),Yii::$app->homeUrl);?>
						</div>
						<div class='col-md-8'>
							<a style='line-height:30px; font-size:20px;'><?= $model->Judul?></a><br>
								( <?= $model->kategori->Kategori ?> | <?= $model->jenis->Jenis ?>)<br>
							Dipublikasikan Oleh: <?= $model->user->pegawai->nama_petugas?><br>
							Tgl Dipublikasikan: <?= $model->PublishDate?><br>
							Dilihat: <?= $model->Requested?> Kali<br>
						</div>
						
					</div>
					<br>
					
					<div class='row'>
					
					<h5><?= $model->kategori->Kategori?> Tebaru</h5>
					
					<?php foreach($dokumen as $a):?>
					
					<div class='col-md-12' style='margin-top:10px;'>
						<div class='row'>
							<div class='col-md-2' style='border:1px solid #ececec; padding-top:10px;  padding-bottom:10px;'><?= Html::a(Html::img(Yii::$app->request->baseUrl.'/frontend/images/book2.png',['class' => 'img  logo pull-right img-responsive']),Yii::$app->homeUrl);?></div>
							<div class='col-md-8'>
							<a style='font-size:10px;'><?= $a->Judul?></a><br>
							Dipublikasikan Oleh : <?= $a->user->pegawai->nama_petugas?><br>
							Tgl Dipublikasikan : <?= $a->PublishDate?><br>
							<i href='<?= Url::to(['perpustakaan/dokumen/'.$model->Id])?>' style='color:blue;'>Lihat >></i>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
					</div>
					
				</div>
			</div>
		</div>
</section>