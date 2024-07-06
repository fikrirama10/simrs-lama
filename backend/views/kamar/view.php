<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Rawatjalan;
/* @var $this yii\web\View */
/* @var $model common\models\Kamar */
$rawat = Rawatjalan::find()->where(['idruangan'=>$model->id])->andwhere(['idjenisrawat'=>2])->andwhere(['status'=>8])->all();
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kamars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="kamar-view">
	<div class='box box-default'>
		<div class='box box-body'>
		<div class='row'>
		<div class='col-md-12'>
		
		<div class="col-md-5">
      
		 <?php foreach($rawat as $r): ?>
		    <?php  
		 $masuk = date('Y-m-d',strtotime($r->tglmasuk));
		 $ihi = date('Y-m-d');
		 $diff =strtotime($ihi)-strtotime($masuk); 
		 ?>
		  <div class="info-box bg-red">
		
		  <div class="info-box bg-green">
            <span class="info-box-icon"><i class='fa fa-bed'>
			</i></span>

            <div class="info-box-content">
              <span class="info-box-text"></span>
              <span class="info-box-number"><a style='color:#fff;' href='<?= Yii::$app->params['baseUrl'].'/dashboard/rawatinap/'.$r->id?>'><?= $r->pasien->sbb?>. <?= $r->pasien->nama_pasien?></a> <i class='pull-right'>Rm  <?= $r->no_rekmed?></i></span>

              <div class="progress">
               
              </div>
                  <span class="progress-description">
                   <?= date('d F Y , G:i A',strtotime($r->tglmasuk)) ?>  <i class='pull-right'><?= floor($diff/86400) ?> Hari </i>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		<?php endforeach;?>
		</div>
		</div>
		</div>
	</div>
</div>
