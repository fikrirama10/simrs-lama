<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use common\models\Template;
use common\models\Ss;
$temp = Template::find()->where(['IdProduk'=> $model->Id])->all();
$sc = Ss::find()->where(['IdProduk'=> $model->Id])->limit(2)->all();
$this->title = $model->Produk;
?>
<?php if($model->IdPaket == 2){ ?>
<section id='layanan'>
	<div class='container'>
		<div class='row'>
		<div class='col-md-12'>
			<div class='gpro'>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/products/'.$model->Gambar,['class'=>'img img-responsive margina','width'=>''])
			?>
			</div>
		</div>
		<div class='col-md-12'>
			<h3><?= $model->Produk ?></h3><hr/>
		</div>
		<div class='col-md-12 ggg'>
			<a style='color:#212121;'><?= $model->Deskripsi ?></a>
		</div>
		</div>
	</div>
	<div class='container' style='margin-top:50px; margin-bottom:40px;'>
		<div class='row'>
			<?php foreach($temp as $t): ?>
			<div class='col-md-3'>
				<div class='jt'>
				<h5 style='text-align:center;'><?= $t->Nama ?></h5><hr/>
				</div>
				<div class='gt'>
				<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/products/template/'.$t->Gambar,['class'=>'img img-responsive margina','width'=>''])
				?>
				</div>
				<div class='deemo'>
				<a class='btn btn-deemo' href='<?= Url::to(['/template/view/'.$t->Id]) ?>'>Lihat demo</a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php }else if($model->IdPaket == 1){?>
<section id='layanan'>
	<div class='container' style='margin-bottom:80px;'>
		<div class='row'>
			<div class='col-md-12'>
				<div class='gpro agpro'>
				
				 <?php 
					// $b=new Ss;
					// $banners=$b::find()->where(['IdProduk' => $model->Id])->all();
					// $arrimg=array();
					// foreach ($banners as $b){
						// array_push($arrimg,['content' => "<img src='".Yii::$app->request->baseUrl."/frontend/images/products/ss/".$b->SS."' class='img-responsive'>",'caption' => '<h3></h3>']);
					// }
					// echo Carousel::widget(['items'=>$arrimg,'options'=>['interval' =>10]]
					// );
				?>
				<hr/>
				<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/products/'.$model->Gambar,['class'=>'img img-responsive margina','width'=>''])
				?>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-md-8'>
				<div class='row'>
					<div class='col-md-2'>
					<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/products/icon/'.$model->Icon,['class'=>'img img-responsive margina','width'=>''])
						?>
					</div>
					
					
					<div class='col-md-8'>
					<h3><?= $model->Produk ?></h3>
					<a><?= $model->Intro ?></a>
				
					</div>
				</div><hr/>
				<div class='row'>
					<div class='col-md-12 ggg'>
						<h4>Deskripsi</h4>
						<p style='text-align:justify;'><?= $model->Deskripsi ?></p>
					</div>
				</div>
			</div>
			<div class='col-md-4'>
				<div class='panel panel-default'>
					<div class='panel-body'>
						<h5>Version : <?= $model->Version ?><h5>
					</div>
				</div>
				<h5>ScreenShoot</h5><hr/>
				<div class='row'>
					<div class='col-md-12'>
						<?php foreach($sc as $s):?>
								<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/products/ss/'.$s->SS,['class'=>'img img-responsive margina','style'=>'margin-bottom:20px;'])
						?>
						<?php endforeach ; ?>
						<a class='btn btn-deeemo' href='<?= Url::to(['/template/view/'.$model->Id]) ?>'>Lihat Lebih Banyak</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<section>
<?php }else if($model->IdPaket == 3){ ?>
<section id='layanan'>
	<div class='col-md-12 googl'>
		
	</div>
	<div class='container'>
		<div class='row' style='margin-bottom:;'>
			<div class='col-md-12 gg'>
			<h1><?= $model->Produk ?></h1><hr/>
				<div class='lh'>
				<p>
					<?= $model->Deskripsi ?>
				</p>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-md-12'style='text-align:center; margin-bottom:100px;'><i>
			<h4>Mau Konsultasi Dengan Tim Kami Untuk Pilihan Paket Terbaik Untuk Bisnis Anda?
			<br>Silahkan hubungi kami.</i></h4><br>
			<a class='btn btn-primary'> Hubungi kami </a>
			</div>
		</div>
	</div>
</section>
<?php } ?>