<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Template */


?>
<section id='layanan'>
	<div class='container' style='padding-bottom:50px;'>
		<div class='row'>
			<div class='col-md-12'>
				<h3><?= $model->Nama ?></h3><hr/>
			</div>
			<div class='col-md-6'>
				<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/products/template/'.$model->Gambar,['class'=>'img img-responsive','width'=>'']) ?>
			</div>
			<div class='col-md-6'>
				<?= $model->Deskripsi ?>
				<div class='row'>
				<div class='col-md-6'>
					<a class='btn btn-deemo' href='<?= Url::to(['/template/view/'.$model->Id]) ?>'>Lihat demo</a>
				</div>
				</div>
			</div>
		</div>
	</div>
</section>