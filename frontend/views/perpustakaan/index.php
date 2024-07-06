<?php
use common\models\DokumenKategori;
use common\models\Dokumen;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$dokat = DokumenKategori::find()->all();

$cd = Dokumen::find()->where(['IdKat'=>2])->count();
$cb = Dokumen::find()->where(['IdKat'=>1])->count();
$cj = Dokumen::find()->where(['IdKat'=>3])->count();
$this->title = 'Perpustakaan Online';
?>
<section>
<section id='pilarian'>
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
        <div class="container">
		<h2 align=center>Selamat Datang di Perpustahaan online RSAU LANUDSULAIMAN</h2><hr>
			<div style='text-align:center;' class='row all-icons-area'>
			
   
                
				<div  class=" col-md-4 ">
                    <div class="medilife-single-icon">
                        <i class="icon-medicine-book-1"></i>
                        <span>Jumlah Buku<h1><span><?= $cb?></span></h1></span>
                    </div>
                </div>
                
                <div class=" col-md-4 ">
                    <div class="medilife-single-icon">
                        <i class="icon-clinic-history-5"></i>
                        <span>Jumlah Dokumen<h1><span><?= $cd?></span></h1></span>
                    </div>
                </div>
                
                <div class=" col-md-4">
                    <div class="medilife-single-icon">
                        <i class="icon-clipboard-2"></i>
                        <span>Jumlah Jurnal<h1><span><?= $cj?></h1></span></span>
                    </div>
                </div>
     
                
         
			</div>
			<div style='text-align:center;' class='row all-icons-area'>
				<?php foreach($dokat as $dk): ?>  
 <div class=" col-md-4">
                    <div class="medilife-single-icon">
                        <i class="icon-clipboard-2"></i>
                        <span><a href='<?= Url::to(['perpustakaan/'.$dk->Id])?>' class='btn btn-primary'><?= $dk->Kategori?></a></span>
                    </div>
                </div>				
					
				<?php endforeach; ?>         
			</div>
			<div class='row' style=' margin-top:0px; '>
				
			<hr>

		</div>
</section>
<div class='container' style='background:#fbfbfb; margin-bottom:100px;'>
	<div class='row'>
	<?php foreach ($dok as $dok): ?>
		<div class='col-xs-4'>
			<div style='background:#fff; padding-left:10px; padding-top:10px; margin-top:10px;' >
				<p><a style='font-weight:50px;' href='<?= Url::to(['dokumen/'.$dok->Id])?>'><?= $dok->Judul?></a></p><br>
				<p style='font-size:10px;'>by <?= $dok->user->username?> | <?= $dok->jenis->Jenis?></p> <br>
				<p><?= date('d F Y',strtotime($dok->PublishDate)) ?></p>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
	<?php
					// display pagination
					echo LinkPager::widget([
						'pagination' => $pagination,
					]);
				?>
</div>
