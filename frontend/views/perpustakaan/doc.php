<?php
use common\models\Dokumen;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<section  class="medilife-blog-area section-padding-100">
        <div class="container"style='margin-top:100px;'>
		<h3>Daftar Dokumen</h3><hr>
				<div class='row'>
				<?php foreach($models as $model):?>
					<div class='col-md-4'>
						<div class='row'>
							<div class='col-md-4' style='border:1px solid #ececec; padding-top:10px;  padding-bottom:10px;'><?= Html::a(Html::img(Yii::$app->request->baseUrl.'/frontend/images/book2.png',['class' => 'img  logo pull-right']),Yii::$app->homeUrl);?></div>
							<div class='col-md-8'>
							<a style='line-height:40px; font-size:20px;'><?= $model->Judul?></a><br>
							Dipublikasikan Oleh : <?= $model->UserId?><br>
							Tgl Dipublikasikan : <?= $model->PublishDate?><br>
							<a href='<?= Url::to(['perpustakaan/dokumen/'.$model->Id])?>' style='color:blue;'>Lihat >></a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
		</div>
</section>