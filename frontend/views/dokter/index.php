<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Dokter;
use common\models\Jadwaldokter;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DokterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$model = Dokter::find()->all();
$this->title = 'Dokters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokter-index">

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Tab 1</a></li>
			  <?php foreach($model as $d):?>
			  <?php $jadwal = Jadwaldokter::find()->where(['iddokter'=>$d->id])->all(); ?>
              <li><a href="#tab_<?= $d->id?>" data-toggle="tab"><?= $d->namadokter ?></a></li>
			  <?php endforeach; ?>
				
            
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <b>How to use:</b>

                <p>Exactly like the original bootstrap tabs except you should use
                  the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                A wonderful serenity has taken possession of my entire soul,
                like these sweet mornings of spring which I enjoy with my whole heart.
                I am alone, and feel the charm of existence in this spot,
                which was created for the bliss of souls like mine. I am so happy,
                my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                that I neglect my talents. I should be incapable of drawing a single stroke
                at the present moment; and yet I feel that I never was a greater artist than now.
              </div>
              <!-- /.tab-pane -->
			   <?php foreach($model as $d):?>
              <div class="tab-pane" id="tab_<?= $d->id?>">
               <?php foreach($jadwal as $j):?>
				<?= $j->hari->nama_hari?><br>
				<?= $j->mulaijam ?>
				<?= $j->selesaijam ?><br>
				<?php endforeach; ?>
				 <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/dokter/'.$d->id?>' class="btn btn-success btn-xs">Lihat</a>
              </div>
              <!-- /.tab-pane -->
				 <?php endforeach; ?>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
	
</div>
