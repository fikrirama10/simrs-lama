<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Dokter;
use common\models\Poli;
use common\models\Jadwaldokter;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DaftaronlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$daftaronline = Poli::find()->all();
$dokter = Dokter::find()->where(['idpoli'=>$model->id])->all();

$this->title = 'Pelayanan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftaronline-index">
<section  class="medilife-blog-area section-padding-100">
  <!-- ***** Services Area Start ***** -->
    <div class="medilife-services-area section-padding-100-20">
        <div class="container">
            <h2>Dokter <?= $model->namapoli?></h2>
			<br><hr><br>
			<div class="row">
                <!-- Single Service Area -->
				<?php foreach($dokter as $d): ?>
			   <div class="col-md-6 col-lg-12" style='border-bottom:1px solid #ececec; padding-top:30px;'>
			   <div class='col-md-6'>
			    <div class="single-service-area d-flex">
                        <div class="service-icon">
                            <i class="icon-doctor"></i>
                        </div>
                        <div class="service-content">
                            <h5><?= $d->namadokter?></h5>
							  <p><?= $model->namapoli?></p>
                            
                        </div>
					</div>
			   </div>
			   <div class='col-md-6'>
			   	<table class='table table-bordered'>
					<tr>
						<th>Hari</th>
						<th>Buka Pendaftaran</th>
						<th>Jam Pemeriksaan</th>
					<tr>
					<?php $jadwal= Jadwaldokter::find()->where(['iddokter'=>$d->id])->all();
					foreach ($jadwal as $j):
					?>
					<tr>
						<td><?= $j->hari->nama_hari?></td>
						<td><?= $j->mulaijam?></td>
						<td><?= $j->selesaijam?></td>
					</tr>
					
					<?php endforeach ?>
					</table>
			   </div>
                   
				
                </div>
				<?php endforeach; ?>
               
            </div>
        </div>
    </div>
    <!-- ***** Services Area End ***** -->
		
</section>
</div>