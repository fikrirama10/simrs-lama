<?php

use yii\helpers\Html;
use common\models\Pasien;
use common\models\Rawatjalan;
use kartik\grid\GridView;
use yii\helpers\Url;
use dosamigos\chartjs\ChartJs;
use yii\widgets\Pjax;
use yii\db\Query;
use yii\web\View;
use kartik\date\DatePicker;
use common\models\Jenisrawat;
use miloschuman\highcharts\Highcharts;
use common\models\Kamar;
use common\models\Dokter;
use common\models\Diagnosa;
use common\models\Rawat;
$jumlahkamar = Kamar::find()->all();
$crawat = Rawat::find()->count();
$rawatinap = Rawat::find()->all();
/* @var $this yii\web\View */
/* @var $searchModel common\models\TransaksiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$jrawat = Jenisrawat::find()->all();
$memb = Pasien::find()->where(['DATE_FORMAT(created_at,"%Y-%m-%d")' => date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))))])->count();
$gigi = Rawatjalan::find()->where(['status'=>1])->andwhere(['idpoli'=>1])->count();
$rj = Rawatjalan::find()->where(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))))])->andwhere(['idjenisrawat'=>1])->count();
$ri = Rawatjalan::find()->where(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))))])->andwhere(['idjenisrawat'=>2])->count();
$igd = Rawatjalan::find()->where(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))))])->andwhere(['idjenisrawat'=>3])->count();
$tempattidur = Kamar::find()->sum('tempattidur');
$masuk = Kamar::find()->sum('masuk');
$ttt = $tempattidur - $masuk ;
$kamar = Kamar::find()->count();
$dokter = Dokter::find()->count();
$kamark = Kamar::find()->where(['status'=>0])->count();
$cd = Rawatjalan::find()->groupby(['kdiagnosa'])->count();
$hitungrj = Rawatjalan::find()
       ->select(['rawatjalan.*', 'COUNT(kdiagnosa) AS hitung'])
	   ->groupBy('kdiagnosa')
       ->orderBy(['hitung' => SORT_DESC])
       ->limit(10);
$datadiag = $hitungrj->all();
$query = Rawatjalan::find()
       ->select(['rawatjalan.*', 'COUNT(kdiagnosa) AS jd'])
	   ->groupBy('kdiagnosa')
       ->orderBy(['jd' => SORT_DESC])
       ->limit(10);
$datas = $query->where(['status'=>3])->all();
$this->title = 'SIMRS ( '.Yii::$app->user->identity->priviledges->privilages.' )';
	
	
	$jenisrawat = Jenisrawat::find()->all();
	$rawat = Rawatjalan::find()->joinWith(['jerawat as jenis'])->groupBy(['jenis.jenisrawat'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
	$bybulan = Rawatjalan::find()->groupBy(['DATE_FORMAT(tgldaftar, "%M")','DATE_FORMAT(tgldaftar, "%Y")'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
	
	$i = 0;
	$j = 0;
	$color = ['#fb954f','#6faab0','#c4c24a','#f6b53f','#e94649', '#48aa9f'];
	
	if(count($bybulan) < 1){
		$bulan[] = [date('M')];
		
		if(count($jenisrawat) < 1){
			$data[] = ['name' => 'perawatan', 'data' => [0], ];
		}else{
			foreach($jenisrawat as $cb):
				$j++;
				$data[] = ['name' => $cb->jenisrawat, 'data' => [0], ];
			endforeach;
		}
	}else{
		foreach($bybulan as $bl):
			$bulan[] = date('F',strtotime($bl->tgldaftar));
		endforeach;
		
		foreach($rawat as $cb):
			$bybulan = Rawatjalan::find()->select(['DATE_FORMAT(tgldaftar, "%M")', 'COUNT(id) as Cnt'])->where(['idjenisrawat'=>$cb->idjenisrawat])->groupBy(['DATE_FORMAT(tgldaftar, "%M")','DATE_FORMAT(tgldaftar, "%Y")'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
			$i++;
			foreach($bybulan as $tr):
				$arraytr[$i][] = (int) $tr->Cnt;
			endforeach;
		endforeach;
		
		foreach($rawat as $cb):
			$j++;
			$data[] = ['name' => $cb->jerawat->jenisrawat, 'data' => $arraytr[$j], ];
		endforeach;
	}
$url = 'https://simrs.rsausulaiman.com/api/kamar';
        $content = Yii::$app->kazo->fetchApiData($url);
        $json = json_decode($content, true);
		
$url2 = 'https://simrs.rsausulaiman.com/apites/kasir-yanmas-day';
        $content2 = Yii::$app->kazo->fetchApiData($url2);
        $json2 = json_decode($content2, true);
?>
<title><?= Html::encode($this->title) ?></title>
<div class="site-index">

<?php if(Yii::$app->user->identity->idpriv == 1){ ?>
<?php 
	//$untung = $data['kasirYanmas']['total'] - $data['pengeluaran']['total'];
 ?>

	<div class="row">
        <div class="col-md-12">
          <div class="box">
           
            
            <div class="box-footer">
			 <h3>Transaksi Bulan Ini</h3> <hr>
				<div class='row'>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-purple">
						<div class="inner">
						  <h3><?= $json2['response']['kasirYanmas']['trx'] ?></h3>
						  <p>Pasien Yanmas </p>
						</div>
						<div class="icon">
						  <i class="fa fa-users"></i>
						</div>
						<a href="<?= Url::to(['/cassa/databayar'])?>"  class="small-box-footer">
						  More info <i class="fa fa-arrow-circle-right"></i>
						</a> 
					  </div> 
					</div>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
						  <h3><?= $json2['response']['kasirBpjs']['trx'] ?></h3>
						  <p>Pasien BPJS</p>
						</div>
						<div class="icon ">
						  <i class="fa fa-users"></i>
						</div>
						<a href="<?= Url::to(['/cassa/databayar'])?>"  class="small-box-footer">
						  More info <i class="fa fa-arrow-circle-right"></i>
						</a> 
					  </div> 
					</div>

				</div>
				<hr>
				 <h3 class='text-center'><b>INCOME</b></h3> <hr>
				<div class='row'>
					<div class="col-lg-6 col-xs-12">
						<div class="small-box" style='background:#b7b7b7;'>
							<div class="inner">
							 <h3 style="color:#fff;" class='text-center'>Rp. <?= Yii::$app->algo->IndoCurr($json2['response']['kasirYanmas']['income'])?></h3>	
							 <p style="color:#fff;" class='text-center'>Pemasukan Pasien Yanmas</p>
							</div>	
							<div class="icon ">
							  <i class="fa fa-money"></i>
							</div>		
							<a href="<?= Url::to(['/yanmas/detail'])?>" class="small-box-footer">
							  More info <i class="fa fa-arrow-circle-right"></i>
							</a> 
						</div>
					</div>
					<div class="col-lg-6 col-xs-12">
						<div class="small-box" style='background:#222d32;'>
							<div class="inner">
							 <h3 style="color:#fff;" class='text-center'>Rp. <?= Yii::$app->algo->IndoCurr($json2['response']['kasirBpjs']['income'])?></h3>	
							 <p style="color:#fff;" class='text-center'>Pemasukan Pasien BPJS</p>
							</div>	
							<div class="icon ">
							  <i class="fa fa-money"></i>
							</div>
							<a href="<?= Url::to(['/lapbpjs/detail'])?>"  class="small-box-footer">
							  More info <i class="fa fa-arrow-circle-right"></i>
							</a> 						
						</div>
					</div>
				</div>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
<?php }else{echo'';} ?>
<div class='box box-body' style='background:#222d32; -webkit-box-shadow: 11px 11px 7px -6px rgba(97,97,97,1);
-moz-box-shadow: 11px 11px 7px -6px rgba(97,97,97,1);
box-shadow: 11px 11px 7px -6px rgba(97,97,97,1);'>
<h3 style="color:#fff;">Ketersediaan Tempat Tidur</h3><hr/>
</div>
<div class='row'>
<?php for($a=0; $a < 9; $a++){?> 
	<a href='#'  data-toggle="modal" data-target="#modal-<?= $json[$a]['Id'] ?>">
		<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box" style='-webkit-box-shadow: 11px 11px 7px -6px rgba(97,97,97,1);
-moz-box-shadow: 11px 11px 7px -6px rgba(97,97,97,1);
box-shadow: 11px 11px 7px -6px rgba(97,97,97,1);'>

            <span class="info-box-icon <?= $json[$a]['Warna']?>"><i class='fa fa-bed'></i></span>
				
            <div class="info-box-content">
              <span class="info-box-text"><?= $json[$a]['Ruangan'] ?> ( <?= $json[$a]['Tempattidur'] ?> BED )</span>
              <span class="info-box-number"> <?= $json[$a]['Kosong'] ?> Kosong</span> 
			  <span class="info-box-text">Kelas <?= $json[$a]['Kelas'] ?></span>
            </div> 
			
			
            <!-- /.info-box-content -->
          </div> 
          <!-- /.info-box -->
        </div>
		</a>
	<?php } ?>
</div>

<?php if(Yii::$app->user->identity->idpriv == 8){ ?>
	<div class="callout callout-danger">
                <h4>Ada Pasien Ke Rawat Inap  </h4>

                <p>Segera Ubah Status Pasien ke rawat inap <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/rawat/'?>'>Klik disini</a></p>
	</div><?php }else{echo"";}?>
 <div class='box box-body'>
<h3>Kunjungan Pasien</h3><hr>
<div class='row'>

  <div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-aqua">
						<div class="inner">
						  <h3><?= $memb?></h3>

						  <p>Pasien Terdaftar</p>
						</div>
						<div class="icon">
						  <i class="fa fa-users"></i>
						</div>
						<a href="<?= Url::to(['/pasien/detail'])?>" class="small-box-footer">
						  More info <i class="fa fa-arrow-circle-right"></i>
						</a>
					  </div>
					</div>
						 <div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-red">
						<div class="inner">
						  <h3><?= $igd?></h3>

						  <p>Pasien Igd</p>
						</div>
						<div class="icon">
						  <i class="fa fa-ambulance"></i>
						</div>
						<a href="<?= Url::to(['/pasien/detailigd'])?>" class="small-box-footer">
						  More info <i class="fa fa-arrow-circle-right"></i>
						</a>
					  </div>
					</div>
					
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-yellow">
						<div class="inner">
						  <h3><?= $ri?></h3> 

						  <p>Pasien RawatInap</p>
						</div>
						<div class="icon">
						  <i class="fa fa-hospital-o"></i>
						</div>
						<a href="#" class="small-box-footer">
						  More info <i class="fa fa-arrow-circle-right"></i>
						</a>
					  </div>
					</div>
					
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
						  <h3><?= $rj?></h3>

						  <p>Pasien Rawatjalan</p>
						</div>
						<div class="icon">
						  <i class="fa fa-stethoscope"></i>
						</div>
						<a href="<?= Url::to(['/pasien/detailpoli'])?>" class="small-box-footer">
						  More info <i class="fa fa-arrow-circle-right"></i>
						</a>
					  </div>
					</div>
							
</div>
</div>
<?php foreach($jumlahkamar as $jk): ?>
<?php $rajal= Rawatjalan::find()->where(['idruangan'=>$jk->id])->andwhere(['status'=>8])->all();
	$no=1;
 ?>
<div class="modal fade" id="modal-<?= $jk->id ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?= $jk->namaruangan ?></h4>
			</div>
		<div class="modal-body">
			<div class = "container-fluid">
				<div class='row'>						
				<table class='table table-bordered'>
					<tr>
						<th>No</th>
						<th>Nama Pasien</th>
						<th>Usia</th>
						<th>Jenis Kelamin</th>
						<th>Tanggal Masuk</th>
						<th>Penjamin</th>
					</tr>
					<?php foreach($rajal as $rj): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $rj->pasien->sbb ?> .<?= $rj->pasien->nama_pasien ?></td>
						<td><?= $rj->pasien->usia ?> th</td>
						<td><?= $rj->pasien->jenis_kelamin ?> </td>
						<td><?= $rj->tglmasuk ?> </td>
						<td><?= $rj->carabayar->jenisbayar ?> </td>
					</tr>
					<?php endforeach; ?>
				</table>
				</div>
			</div>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		</div>
		</div>
	<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>
<?php endforeach; ?>
