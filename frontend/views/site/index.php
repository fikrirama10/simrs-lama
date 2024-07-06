
<?php
use yii\helpers\Html;
use common\models\Articles;
$this->title ='RSAU LANUD SULAIMAN';
?>

<script src="https://use.fontawesome.com/9c89c14c23.js"></script>
<div class='container-fluid mt-3'>
	<div style='background-image:url("config/img/139861.jpg"); color:#fff; background-size:cover; ' class="jumbotron">
		<h1 class="display-4">Siap Melayani Sepenuh hati </h1>
		<p class="lead">
			<i><b>"Terwujudnya rumah sakit TNI AU yang handal dalam dukungan kesehatan dan prima dalam pelayanan kesehatan"</b></i>
		</p>
		<hr class="my-4">
		<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
		<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
	</div>
	<hr>
</div>

<section id='pilarian' class='hide-xs' style='top:10;'>
	<div class='container'>
		<div class='row'>
			<div class='col-md-2' style='border-right:1px solid #a0b1c3;'>
			
			</div>
			<div class='col-md-10'>
				<div class='row'>
					<div class='col-md-2'>
						<p style='line-height:70px; font-size:13pt;'>Cari Buku</p>
					</div>
					<div class='col-md-5'>
						<form role="search" action="/simrs/perpustakaan/pencarian" method="get">
							
								<input type="text" name='keyword'  placeholder="cari dokumen">

					</div>
					<div class='col-md-2'>
						  <input type="submit" value="Search">
						</form>
					</div>
					<div class='col-md-3' style='text-align:right; '>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id='barang'>
	<div class='container'>
		<div class='row'>
			<div class='col-md-12' style='text-align:center; margin-top:50px;'>
				<h3>Pelayanan Kami</h3>
				<h5><i>"Terwujudnya rumah sakit TNI AU yang handal dalam dukungan kesehatan dan prima dalam pelayanan kesehatan"</i></h5>
			</div>
		</div>
		<div class='row'>
	
			<div class='col-md-4 mmbl' href='#'>
				<div class='gambar'>
				<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/resource/s.jpg',['class'=>'img img-responsive margina','width'=>'100%']) ?>
				</div>
				<div class='judul'>
				<p class='sub'>IGD 24 JAM</p><br>
				<div class='subb'>
				Instansi Gawat Darurat yang siap melayani 24 jam
				</div>
				</div>
			</div>
	
				<div class='col-md-4 mmbl' href='#'>
				<div class='gambar'>
				<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/resource/paste3.jpg',['class'=>'img img-responsive margina','width'=>'100%']) ?>
				</div>
				<div class='judul'>
				<p class='sub'>Poliklinik</p><br>
				<div class='subb'>
				Ditangani Oleh Dokter yang profesional di bidangnya
				</div>
				</div>
			</div>
				<div class='col-md-4 mmbl' href=''>
				<div class='gambar'>
				<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/resource/rawat-inap-rumah-sakit.jpg',['class'=>'img img-responsive margina','width'=>'100%']) ?>
				</div>
				<div class='judul'>
				<p class='sub'>Rawat Inap</p><br>
				<div class='subb'>
				Ruangan Perawatan Dari Kelas 1 sampai Kelas 3
				</div>
				</div>
			</div>
		</div>
	</div>
</section>



<section id='os'>
	<div class='container'>
		<div class='col-md-7'>
			<h1>RSAU LANUD SULAIMAN</h1>
			<h3>Aman , Kualitas , Unggul , Ramah , Aman , Terampil ( AKURAT )</h3>
			
		<div class='row'>
			<div class='col-md-12'>
				<iframe width="95%" style='margin-top:50px;' height="315"
				src="https://www.youtube.com/embed/uiP-z2UoC1A">
				</iframe> 
			</div>
		</div>
		</div>
		<div class='col-md-5'  style='padding-top:70px;'>
			<div class='row' style='margin-bottom:15px;'>
				<div class='col-xs-3 pc'>
				<i class="fa fa-fw fa-hourglass-end" style=''></i>
					<?php // Html::img(Yii::$app->params['baseUrl'].'/frontend/images/resource/ico-9.png',['class'=>'img img-responsive margina','width'=>'']) ?>
				</div>
				<div class='col-xs-9' style='padding-top:0px; '>
					<h5>Farmasi 24 Jam</h5>
					<a style='color:#9d9d9d;'>Pelayanan Farmasi Dalam 24 jam </a>
				</div>
			</div>
			<div class='row' style='margin-bottom:15px;'>
				<div class='col-xs-3 pc'>
				 <i class="fa fa-fw  fa-balance-scale" style=''></i>
					<?php // Html::img(Yii::$app->params['baseUrl'].'/frontend/images/resource/40-512.png',['class'=>'img img-responsive margina','width'=>'']) ?>
				</div>
				<div class='col-xs-9' style='padding-top:0px; '>
					
					<h5>IGD 24 Jam</h5>
					<a style='color:#9d9d9d;'>Instalasi Gawat Darurat Sealu Siaga Selama 24 jam</a>
				</div>
			</div>
			<div class='row' style='margin-bottom:15px;'>
				<div class='col-xs-3 pc'>
				<i class="fa fa-fw fa-tasks" style=''></i>
					<?php // Html::img(Yii::$app->params['baseUrl'].'/frontend/images/resource/serve.png',['class'=>'img img-responsive margina','width'=>'']) ?>
				</div>
				<div class='col-xs-9' style='padding-top:0px; '>
					<h5>Radiologi 24 Jam</h5>
					<a style='color:#9d9d9d;'>Pelayanan Radiologi Dalam 24 jam</a>
				</div>
			</div>
			<div class='row' style='margin-bottom:15px;'>
				<div class='col-xs-3 pc'>
				
				<i class="fa fa-fw fa-thumbs-o-up" style=''></i>
					<?php // Html::img(Yii::$app->params['baseUrl'].'/frontend/images/resource/award_icon.png',['class'=>'img img-responsive margina','width'=>'']) ?>
				</div>
				<div class='col-xs-9' style='padding-top:0px; '>
					<h5>Laboratorium 24 Jam</h5>
					<a style='color:#9d9d9d;'>Pelayanan Laboratorium Dalam 24 jam.</a>
				</div>
			</div>
			<div class='row' style='margin-bottom:15px;'>
				<div class='col-xs-3 pc'>
				<i class="fa fa-fw  fa-users" style=''></i>
					<?php // Html::img(Yii::$app->params['baseUrl'].'/frontend/images/resource/support-service.jpg',['class'=>'img img-responsive margina','width'=>'']) ?>
				</div>
				<div class='col-xs-9' style='padding-top:0px; '>
					<h5>Dokter Spesialis</h5>
					<a style='color:#9d9d9d;'>Dokter Spesialis yang handal dalam bidangnya.</a>
				</div>
			</div>
			
		</div>
	</div>
</section>
</section>