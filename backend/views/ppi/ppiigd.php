<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Rawatjalan;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$rj = Rawatjalan::find()->where(['idjenisrawat'=>3])->orderby(['tgldaftar' => SORT_DESC])->all();
$this->title = 'Ppis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppi-index">

        <div class="col-xs-12">
		
          <div class="box box-primary" style='margin-top:20px;'>
            <div class="box-header">
              <h4>Prosedur Pencegahan Infeksi ( PPI ) Pasien IGD</h4>
				<hr>
              <div class="box-tools">
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
               
				<tr>
                  <th>RM</th>
                  <th>Id Rawat</th>
                  <th>Nama Pasien</th>
                  <th>Nama Dokter</th>
                  <th>Nama Perawat</th>
                  <th>Aksi</th>
                </tr>
					
				 <?php foreach($rj as $r): ?>
					
                <tr>
				<td><?= $r->no_rekmed ?></td>
				<td><?= $r->idrawat ?></td>
                <td><?= $r->pasien->nama_pasien?></td>
                <td><?= $r->dokter->namadokter?></td>
                
                <td><a href='<?= Url::to(['ppi/vppi/'.$r->id]) ?>'><span class="label label-success"><i class="fa fa-hand-stop-o"></i></span></a></td>
                </tr>
					
				<?php endforeach; ?>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
	
			

</div>
