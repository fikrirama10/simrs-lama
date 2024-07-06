<?php
use common\models\Dokumen;
use common\models\DokumenJenis;
use yii\helpers\Html;
use yii\helpers\Url;
$dokumen = Dokumen::find()->where(['IdKat'=>$model->Id])->all();
$jenis = DokumenJenis::find()->where(['IdKat'=>2])->all();
?>
<section  class="medilife-blog-area section-padding-100">
        <div class="container"style='margin-top:100px;'>
		
		<h1><?= $model->Kategori?></h1><hr><br>	
		<form role="search" action="/simrs/perpustakaan/pencarian" method="get">
							<div class="form-group">
								<input type="text" name='keyword' class="form-control form-outline-sm" placeholder="cari dokumen">
							</div>
							 
							</form>
			<div class='row'>
			
			<?php if($model->Id == 2){ ?>
			<?php foreach($jenis as $j): ?>
				<div class='col-md-2'>
				<?= Html::a(Html::img(Yii::$app->request->baseUrl.'/frontend/images/book2.png',['class' => 'img img-responsive logo pull-left']),Url::to(['perpustakaan/doc/'.$j->Id]));?>
				
				<center><?= $j->Jenis?></center>
					
				</div>
			<?php endforeach;?>
			
			<?php }else{?>
				<div class='col-md-12'>
					<div class='row'>
						<?php foreach($dokumen as $d):?>
						<div class='col-md-4'style='padding-top:10px;  padding-bottom:10px;' >
							<div class='row'>
							<div class='col-md-4' style='border:1px solid #ececec; '><?= Html::a(Html::img(Yii::$app->request->baseUrl.'/frontend/images/book2.png',['class' => 'img  logo pull-right']),Yii::$app->homeUrl);?></div>
							<div class='col-md-8'>
							<a style='font-size:16px;'><?= $d->Judul?></a><br>
							Dipublikasikan Oleh : <?= $d->UserId?><br>
							Tgl Dipublikasikan : <?= $d->PublishDate?><br>
							<a href='<?= Url::to(['perpustakaan/dokumen/'.$d->Id])?>' style='color:blue;'>Lihat >></a>
							</div>
						</div>
					</div>
					<?php endforeach;?>
						</div>
						
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
</section>