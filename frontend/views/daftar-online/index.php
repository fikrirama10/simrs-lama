<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Daftaronline;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DaftaronlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$daftaronline = Daftaronline::find()->where(['DATE_FORMAT(tanggal,"%Y-%m-%d")' => date('Y-m-d')])->all();
$this->title = 'Daftaronlines';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

</style>
<div class="daftaronline-index" style=''>
<section  class="medilife-blog-area section-padding-100">

        <div class="container  bawah"style='margin-top:100px;'>
		<h2 align=center>Selamat Datang di Pendaftaran online RSAU LANUDSULAIMAN</h2><hr><br>
		 <a href="<?= Url::to(['/daftar-online/daftar'])?>" class="btn medilife-btn pull-right">Daftar<span>+</span></a>
			<h3>Kuota Poli yang Tersedia Hari ini:</h3><br><br>
			
			<div class='row all-icons-area'>
					<?php foreach($daftaronline as $df):?>
					
					<div  class=" col-md-4 ">
					
                    <div class="medilife-single-icon">
                        <i class="<?= $df->polie->icon?>"></i>
                        <h1><span><?= $df->polie->namapoli?><h3><br><span><?= $df->kuota?> Pasien</span></h3></span></h1>
                    </div>
					
                </div>
					<?php endforeach ; ?>
			</div>
		</div>
</section>
</div>
