<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DokterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<title><?= Html::encode($this->title) ?></title>
<aside class="main-sidebar">

    <section class="sidebar">
	<div class='row'>
		<div class='col-md-12'>
		<div style='width:100%; background:#e3e3e3; padding:10px 0px 10px 10px; border-bottom:4px solid #3c8dbc ;' >
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/img/core-img/logo3.png',['class'=>'img img-responsive','width'=>'50%']) ?>
		</div>
		</div>
	</div>
<?php
if(Yii::$app->user->identity->idpriv == 1)
		
		$datamaster =
					[
						'label' => 'Data Master',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien', 'icon' => 'fas fa-cart-plus', 'url' => ['/pasien/index'],],
							['label' => 'Data Dokter', 'icon' => 'fas fa-user-md', 'url' => ['/dokter'],],
							['label' => 'Data Petugas', 'icon' => 'fas fa-users', 'url' => ['/user/index'],],
							['label' => 'Data Rawat', 'icon' => 'fas fa-h-square', 'url' => ['/rawatjalan/laporanrawat'],],
							
						],
						
					];

		$perawat =
					[
						'label' => 'Data Keperawatan',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien', 'icon' => 'fas fa-cart-plus', 'url' => ['/keperawatan'],],
							
							
						],
						
					];
						
						
		$apotek =[
						'label' => 'Farmasi',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Antrian Apotek', 'icon' => 'fa fa-cart-plus', 'url' => ['resep'],],
							['label' => 'Apotek Umum (Luar)', 'icon' => 'fa fa-cart-plus', 'url' => ['apotekumum'],],
							['label' => 'Apotek Unit', 'icon' => 'fa fa-cart-plus', 'url' => ['apotek-unit'],],
							['label' => 'Laporan', 'icon' => 'fa fa-cart-plus', 'url' => ['apotek/laporanharian'],],
							['label' => 'Data Obat', 'icon' => 'fa fa-file-o', 'url' => ['#'],],
							
						],
						
					];
		$cassa =[
						'label' => 'Cassa',
						'icon' => 'fas fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Antrian Pembayaran', 'icon' => 'fas fa-cart-plus', 'url' => ['/cassa'],],
							['label' => 'Data Pembayaran', 'icon' => 'fas fa-file-o', 'url' => ['#'],],
							
						],
						
					];
		
		$poli =
					[
						'label' => 'Poli',
						'icon' => 'fas fa-heartbeat',
						'url' => '#',
						'items' => [
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi'],],
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak'],],
							['label' => 'Poli Bedah', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polibedah'],],
							['label' => 'Poli Kandungan', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polikandungan'],],
							['label' => 'Poli Penyakit Dalam', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polipenyakitdalam'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$igd =
					[
						'label' => 'IGD',
						'icon' => 'fas fa-ambulance',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$ppi =
					[
						'label' => 'PPI',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'PPI', 'icon' => 'fas fa-ambulance ', 'url' => ['/ppi'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$pmkp =
					[
						'label' => 'PMKP ',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
						['label' => 'PMKP (Indikator Prioritsas)',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'AREA KLINIK 1', 'icon' => 'fas fa-ambulance ', 'url' => ['/asesmenpasien'],],
							['label' => 'AREA KLINIK 2', 'icon' => 'fas fa-ambulance ', 'url' => ['/prlab'],],
							['label' => 'AREA KLINIK 3', 'icon' => 'fas fa-ambulance ', 'url' => ['/pradiologi'],],	
							['label' => 'AREA KLINIK 4', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
							['label' => 'AREA KLINIK 5', 'icon' => 'fas fa-ambulance ', 'url' => ['/kesalahanobat'],],	
							['label' => 'AREA KLINIK 6', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
						]
						],
						['label' => 'PMKP (Indikator Unit)',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Unit Gawat Darurat', 'icon' => 'fas fa-ambulance ', 'url' => ['/indikatorigd'],],
							['label' => 'Instalasi Rawar Jalan', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],
							['label' => 'Instalasi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
							['label' => 'Instalasi Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
							['label' => 'Instalasi Farmasi', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
							['label' => 'Instalasi Kamar Oprasi', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
						]
						]
							
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$statistik =
					[
						'label' => 'Demografi',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Demografi Pasien', 'icon' => 'fas fa-ambulance ', 'url' => ['/pasien/pass'],],
							['label' => 'Demografi Poli', 'icon' => 'fas fa-ambulance ', 'url' => ['/poli/demopoli'],],
							['label' => 'Demografi Diagnosa', 'icon' => 'fas fa-ambulance ', 'url' => ['/diagnosa/demodiag'],],
							['label' => 'Data Rawatjalan', 'icon' => 'fas fa-ambulance ', 'url' => ['/laporan/laporanrawat'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$lab =
					[
						'label' => 'Laboratorium',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							['label' => 'Demografi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
							

}
else if(Yii::$app->user->identity->idpriv == 2){
		
		$datamaster =
					[
						'label' => 'Data Master',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien', 'icon' => 'fas fa-cart-plus', 'url' => ['/pasien/index'],],
							['label' => 'Data Dokter', 'icon' => 'fas fa-user-md', 'url' => ['/dokter'],],
							['label' => 'Data Petugas', 'icon' => 'fas fa-users', 'url' => ['/user/index'],],
							['label' => 'Data Rawat', 'icon' => 'fas fa-h-square', 'url' => ['/rawatjalan/laporanrawat'],],
							
						],
						
					];
		
		$apotek =[
						'label' => 'Farmasi',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Antrian Apotek', 'icon' => 'fa fa-cart-plus', 'url' => ['resep'],],
							['label' => 'Apotek Umum (Luar)', 'icon' => 'fa fa-cart-plus', 'url' => ['apotekumum'],],
							['label' => 'Apotek Unit', 'icon' => 'fa fa-cart-plus', 'url' => ['apotek-unit'],],
							['label' => 'Laporan', 'icon' => 'fa fa-cart-plus', 'url' => ['apotek/laporanharian'],],
							['label' => 'Data Obat', 'icon' => 'fa fa-file-o', 'url' => ['#'],],
							
						],
						
					];
		$cassa =[
						'label' => 'Cassa',
						'icon' => 'fas fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Antrian Pembayaran', 'icon' => 'fas fa-cart-plus', 'url' => ['/cassa'],],
							['label' => 'Data Pembayaran', 'icon' => 'fas fa-file-o', 'url' => ['#'],],
							
						],
						
					];
		
		$poli =
					[
						'label' => 'Poli',
						'icon' => 'fas fa-heartbeat',
						'url' => '#',
						'items' => [
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi'],],
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak'],],
							['label' => 'Poli Bedah', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polibedah'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$igd =
					[
						'label' => 'IGD',
						'icon' => 'fas fa-ambulance',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$ppi =
					[
						'label' => 'PPI',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'PPI', 'icon' => 'fas fa-ambulance ', 'url' => ['/ppi'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$pmkp =
					[
						'label' => 'PMKP ',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
						['label' => 'PMKP (Indikator Prioritsas)',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'AREA KLINIK 1', 'icon' => 'fas fa-ambulance ', 'url' => ['/asesmenpasien'],],
							['label' => 'AREA KLINIK 2', 'icon' => 'fas fa-ambulance ', 'url' => ['/prlab'],],
							['label' => 'AREA KLINIK 3', 'icon' => 'fas fa-ambulance ', 'url' => ['/pradiologi'],],	
							['label' => 'AREA KLINIK 4', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
							['label' => 'AREA KLINIK 5', 'icon' => 'fas fa-ambulance ', 'url' => ['/kesalahanobat'],],	
							['label' => 'AREA KLINIK 6', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
						]
						],
						['label' => 'PMKP (Indikator Unit)',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Unit Gawat Darurat', 'icon' => 'fas fa-ambulance ', 'url' => ['/indikatorigd'],],
							['label' => 'Instalasi Rawar Jalan', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],
							['label' => 'Instalasi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
							['label' => 'Instalasi Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
							['label' => 'Instalasi Farmasi', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
							['label' => 'Instalasi Kamar Oprasi', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
						]
						]
							
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$statistik =
					[
						'label' => 'Demografi',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Demografi Pasien', 'icon' => 'fas fa-ambulance ', 'url' => ['/pasien/pass'],],
							['label' => 'Demografi Poli', 'icon' => 'fas fa-ambulance ', 'url' => ['/poli/demopoli'],],
							['label' => 'Demografi Diagnosa', 'icon' => 'fas fa-ambulance ', 'url' => ['/diagnosa/demodiag'],],
							['label' => 'Data Rawatjalan', 'icon' => 'fas fa-ambulance ', 'url' => ['/ppi/ppipoli'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$lab =
					[
						'label' => 'Laboratorium',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							['label' => 'Demografi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$perawat='';
							

}
else if(Yii::$app->user->identity->idpriv == 3){
	$datamaster =
					[
						'label' => 'Data Master',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien', 'icon' => 'fa fa-cart-plus', 'url' => ['/pasien'],],
							
						],
						
					];
	$apotek="";
	$cassa="";
	$poli="";
	$igd="";
	$lab="";
	$ppi="";
	$pmkp="";
	$statistik="";
	$perawat='';

}else if(Yii::$app->user->identity->idpriv == 4){
	$datamaster ="";
	$apotek="";
	$cassa="";
	$poli=[
						'label' => 'Poli',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi'],],
							
						],
						
					];	
	$igd="";
	$lab="";
	$ppi="";
	$statistik="";
	$pmkp="";
	$perawat='';
	
}
else if(Yii::$app->user->identity->idpriv == 5){
	$datamaster ="";
	$apotek =[
						'label' => 'Farmasi',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Antrian Apotek', 'icon' => 'fa fa-cart-plus', 'url' => ['resep'],],
							['label' => 'Apotek Umum (Luar)', 'icon' => 'fa fa-cart-plus', 'url' => ['apotekumum'],],
							['label' => 'Apotek Unit', 'icon' => 'fa fa-cart-plus', 'url' => ['apotek-unit'],],
							['label' => 'Laporan', 'icon' => 'fa fa-cart-plus', 'url' => ['apotek/laporanharian'],],
							['label' => 'Data Obat', 'icon' => 'fa fa-file-o', 'url' => ['#'],],
							
						],
						
					];
	$cassa="";
	$poli="";	
	$igd="";	
	$lab="";	
	$ppi="";
	$pmkp="";
	$statistik="";	
	$perawat='';
	
}
else if(Yii::$app->user->identity->idpriv == 6){
	$datamaster ="";
	$apotek="";
	$cassa=[
						'label' => 'Cassa',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Pembayaran', 'icon' => 'fa fa-cart-plus', 'url' => ['/cassa'],],
							
						],
						
					];
	$poli="";	
	$igd="";
	$lab="";
	$ppi="";
	$statistik="";
	$pmkp="";
	$perawat='';
}
else if(Yii::$app->user->identity->idpriv == 7){
	$datamaster ="";
	$apotek="";
	$cassa=[
						'label' => 'Cassa',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Pembayaran', 'icon' => 'fa fa-cart-plus', 'url' => ['/cassa'],],
							
						],
						
					];
	$poli="";	
	$igd="";
	$perawat='';
	$lab="";
	$ppi="";
	$statistik="";
	$pmkp="";
}
else if(Yii::$app->user->identity->idpriv == 8){
	$datamaster ="";
	$apotek="";
	$cassa="";
	$poli=[
						'label' => 'Poli',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak'],],
							
						],
						
					];	
	$igd="";
	$lab="";
	$ppi="";
	$statistik="";
	$pmkp="";
	$perawat='';
	
}
else if(Yii::$app->user->identity->idpriv == 9){
	$datamaster ="";
	$apotek="";
	$cassa="";
	$poli="";
	$igd =
					[
						'label' => 'IGD',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$lab="";
	$ppi="";
	$statistik="";
	$pmkp="";
	$perawat='';
}
else if(Yii::$app->user->identity->idpriv == 10 ){
	$datamaster ="";
	$apotek="";
	$cassa="";
	$poli="";
	$perawat='';
	$igd =
					[
						'label' => 'IGD',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$lab="";
	$ppi =
		[
		'label' => 'PPI',
		'icon' => 'fas  fa-user-md',
		'url' => '#',
		'items' => [
		['label' => 'PPI', 'icon' => 'fas fa-ambulance ', 'url' => ['/ppi'],],
		//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
					
		],
						
		];
	$statistik="";
	$pmkp="";
}
else if(Yii::$app->user->identity->idpriv == 11){
	$datamaster ="";
	$apotek="";
	$cassa="";
	$poli="";
	$igd ="";
	$lab="";
	$ppi =
		[
		'label' => 'PPI',
		'icon' => 'fas  fa-user-md',
		'url' => '#',
		'items' => [
		['label' => 'PPI', 'icon' => 'fas fa-ambulance ', 'url' => ['/ppi'],],
		//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
					
		],
						
		];
	$statistik="";
	$pmkp="";
	$perawat='';
}
else if(Yii::$app->user->identity->idpriv == 12){
	$datamaster ="";
	$apotek="";
	$perawat='';
	$cassa="";
	$poli= [
						'label' => 'Poli',
						'icon' => 'fas fa-heartbeat',
						'url' => '#',
						'items' => [
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi'],],
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak'],],
							['label' => 'Poli Bedah', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polibedah'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$igd ="";
	$lab="";
	$ppi =
		[
		'label' => 'PPI',
		'icon' => 'fas  fa-user-md',
		'url' => '#',
		'items' => [
		['label' => 'PPI', 'icon' => 'fas fa-ambulance ', 'url' => ['/ppi'],],
		//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
					
		],
						
		];
	$statistik="";
	$pmkp="";
}
else if(Yii::$app->user->identity->idpriv == 13){
	$datamaster ="";
	$apotek="";
	$cassa="";
	$poli= "";
	$perawat='';
	$igd ="";
	$lab =
					[
						'label' => 'Laboratorium',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							['label' => 'Demografi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$ppi =
		[
		'label' => 'PPI',
		'icon' => 'fas  fa-user-md',
		'url' => '#',
		'items' => [
		['label' => 'PPI', 'icon' => 'fas fa-ambulance ', 'url' => ['/ppi'],],
		//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
					
		],
						
		];
	$statistik="";
	$pmkp="";
}
else if(Yii::$app->user->identity->idpriv == 14){
	$datamaster ="";
	$apotek="";
	$cassa="";
	$poli= "";
	$perawat='';
	$igd ="";
	$lab =
					[
						'label' => 'Laboratorium',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							['label' => 'Demografi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$ppi =
		[
		'label' => 'PPI',
		'icon' => 'fas  fa-user-md',
		'url' => '#',
		'items' => [
		['label' => 'PPI', 'icon' => 'fas fa-ambulance ', 'url' => ['/ppi'],],
		//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
					
		],
						
		];
	$statistik="";
	$pmkp="";
}
else if(Yii::$app->user->identity->idpriv == 15){
	$datamaster ="";
	$apotek="";
	$cassa="";
	$perawat='';
	$poli= [
						'label' => 'Poli',
						'icon' => 'fas fa-heartbeat',
						'url' => '#',
						'items' => [
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi'],],
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak'],],
							['label' => 'Poli Bedah', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polibedah'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$igd =
					[
						'label' => 'IGD',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$lab =
					[
						'label' => 'Laboratorium',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							['label' => 'Demografi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$ppi =
		[
		'label' => 'PPI',
		'icon' => 'fas  fa-user-md',
		'url' => '#',
		'items' => [
		['label' => 'PPI', 'icon' => 'fas fa-ambulance ', 'url' => ['/ppi'],],
		//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
					
		],
						
		];
	$statistik="";
	$pmkp="";
}
else if(Yii::$app->user->identity->idpriv == 15){
	$datamaster ="";
	$apotek="";
	$cassa="";
	$poli= [
						'label' => 'Poli',
						'icon' => 'fas fa-heartbeat',
						'url' => '#',
						'items' => [
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi'],],
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak'],],
							['label' => 'Poli Bedah', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polibedah'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$igd =
					[
						'label' => 'IGD',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$lab =
					[
						'label' => 'Laboratorium',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab/listlab'],],
							//['label' => 'Demografi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$ppi ="";
	$statistik="";
	$pmkp="";
	$perawat='';
}
else if(Yii::$app->user->identity->idpriv == 16){
	$datamaster ="";
	$apotek="";
	$cassa="";
	$poli= "";
	$igd ="";
	$perawat='';
	$lab =
					[
						'label' => 'Laboratorium',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab/listlab'],],
							//['label' => 'Demografi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['#'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$ppi ="";
	$statistik="";
	$pmkp="";
}

?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
					
					['label' => 'Dashboard', 'icon' => 'fas fa-hospital-o', 'url' => ['/'],],
					
						$datamaster,	
						$apotek,
						$cassa,
						$poli,
						$igd,
						$lab,
						$ppi,
						$perawat,
						$pmkp,
						$statistik,
				
					
				
				
                ],
            ]
        ) ?>

    </section>

</aside>
