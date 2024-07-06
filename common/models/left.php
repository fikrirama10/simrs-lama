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
	<div class="user-panel">
            <div class="pull-left image">
               <?php if(Yii::$app->user->identity->pegawai->avatar == null){ ?>
			<?php if(Yii::$app->user->identity->pegawai->jk == "L"){ ?>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/tes.png', ['alt'=>'no picture', 'class'=>'user-img img-circle'])?>
			
			<?php }else{ ?>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/tees2.png', ['alt'=>'no picture', 'class'=>'user-img img-circle'])?>
			<?php } ?>
			
			<?php }else{?>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.Yii::$app->user->identity->pegawai->avatar, ['alt'=>'no picture', 'class'=>'user-img img-circle'])?>
			<?php } ?>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->pegawai->nama_petugas ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
<?php
if(Yii::$app->user->identity->idpriv == 1){
		
		$datamaster =
					[
						'label' => 'Data Master',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Laporan Keuangan', 'icon' => 'fas  fa-file-text-o', 'url' => ['/pasien/index'],],
							['label' => 'Laporan BPJS', 'icon' => 'fas  fa-file-text-o', 'url' => ['/user/index'],],
							['label' => 'Laporan Farmasi', 'icon' => 'fas  fa-file-text-o', 'url' => ['/rawatjalan/laporanrawat'],],
							['label' => 'Laporan Kunjungan Pasien', 'icon' => 'fas  fa-file-text-o', 'url' => ['/rawatjalan/laporanrawat'],], 
							
							
						],  
						
					];
		$online =[];
		$jurnal =[];

		$perawat =[];
						
						
		$apotek =[];
		$gudang =[];
		$cassa =[];
		
		$poli =[];
		$igd =[];
		$ppi =[];
		
		$pmkp =[];
		$statistik =[];
		$lab =[];
		$rad =[];
		$usg=[];
							

}
else if(Yii::$app->user->identity->idpriv == 22){
		
		$datamaster =
					[
						'label' => 'Data Master',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien Daftar Online', 'icon' => 'fas fa-cart-plus', 'url' => ['/pasienonline'],],
							['label' => 'Data Pasien', 'icon' => 'fas fa-cart-plus', 'url' => ['/pasien/index'],],
							['label' => 'Data Dokter', 'icon' => 'fas fa-user-md', 'url' => ['/dokter'],],
							['label' => 'Data Petugas', 'icon' => 'fas fa-users', 'url' => ['/user/index'],],
							['label' => 'Data Rawat', 'icon' => 'fas fa-h-square', 'url' => ['/rawatjalan/laporanrawat'],],
							['label' => 'Bor Los Toi', 'icon' => 'fas fa-h-square', 'url' => ['/borlostoi'],],
							
						],
						
					];
		$online =
					[
						'label' => 'Data Online',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien Daftar Online', 'icon' => 'fas fa-cart-plus', 'url' => ['/pasienonline'],],
							['label' => 'Kuota', 'icon' => 'fas fa-cart-plus', 'url' => ['/daftar-online'],],
							['label' => 'Statistik', 'icon' => 'fas fa-user-md', 'url' => ['/dokter'],],
							
							
						],
						
					];
		$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
					
		

		$perawat =
					[
						'label' => 'Data Keperawatan',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien', 'icon' => 'fas fa-cart-plus', 'url' => ['/keperawatan'],],
							['label' => 'Diagnosa Pasien', 'icon' => 'fas fa-cart-plus', 'url' => ['/keperawatan/diagnosa'],],
							
							
						],
						
					];
						
						
		$apotek =[
						'label' => 'Farmasi',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Antrian Apotek', 'icon' => 'fa fa-cart-plus', 'url' => ['/resep'],],
							['label' => 'Apotek Umum (Luar)', 'icon' => 'fa fa-cart-plus', 'url' => ['/apotekumum'],],
							['label' => 'Apotek Unit', 'icon' => 'fa fa-cart-plus', 'url' => ['/apotek-unit'],],
							['label' => 'Laporan', 'icon' => 'fa fa-cart-plus', 'url' => ['/apotek/laporan-harian'],],
							['label' => 'Data Obat', 'icon' => 'fa fa-file-o', 'url' => ['/apotek'],],
							
						],
						
					];
		$gudang =[];
		$cassa =[
						'label' => 'Cassa',
						'icon' => 'fas fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Antrian Pembayaran', 'icon' => 'fas fa-cart-plus', 'url' => ['/cassa'],],
							['label' => 'Laporan Harian', 'icon' => 'fas fa-file-o', 'url' => ['/yanmas'],],
							['label' => 'Pengeluaran', 'icon' => 'fas fa-file-o', 'url' => ['/pengeluaran'],],
							
						],
						
					];
		
		$poli =
					[
						'label' => 'Poli',
						'icon' => 'fas fa-heartbeat',
						'url' => '#',
						'items' => [
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi2'],],
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak2'],],
							['label' => 'Poli Bedah', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polibedah2'],],
							['label' => 'Poli Kandungan', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polikandungan2'],],
							['label' => 'Poli Penyakit Dalam', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polidalam2'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$igd =
					[
						'label' => 'IGD',
						'icon' => 'fas fa-ambulance',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd2'],],
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
						['label' => 'Area Klinik',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'AREA KLINIK 1', 'icon' => 'fas fa-ambulance ', 'url' => ['/asesmenpasien'],],
							['label' => 'AREA KLINIK 2', 'icon' => 'fas fa-ambulance ', 'url' => ['/ert'],],
							['label' => 'AREA KLINIK 3', 'icon' => 'fas fa-ambulance ', 'url' => ['/antibiotik'],],	
							['label' => 'AREA KLINIK 4', 'icon' => 'fas fa-ambulance ', 'url' => ['/apd'],],	
							['label' => 'AREA KLINIK 5', 'icon' => 'fas fa-ambulance ', 'url' => ['/cp'],],	
						]
						],
						//area sasaran
						['label' => 'Area SKP',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'SKP 1', 'icon' => 'fas fa-ambulance ', 'url' => ['/gelang'],],
							['label' => 'SKP 2', 'icon' => 'fas fa-ambulance ', 'url' => ['/transferpasien'],],
							['label' => 'SKP 3', 'icon' => 'fas fa-ambulance ', 'url' => ['/'],],	
							['label' => 'SKP 4', 'icon' => 'fas fa-ambulance ', 'url' => ['/prosm'],],	
							['label' => 'SKP 5', 'icon' => 'fas fa-ambulance ', 'url' => ['/cuciigd'],],	
							['label' => 'SKP 6', 'icon' => 'fas fa-ambulance ', 'url' => ['/karj'],],	
						]
						]
						
						]
						],
						['label' => 'PMKP (Indikator Unit)',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Unit Gawat Darurat', 'icon' => 'fas fa-ambulance ', 'url' => ['/indikatorigd'],],
							['label' => 'Unit Rekam Medis', 'icon' => 'fas fa-ambulance ', 'url' => ['/inaprm'],],
							['label' => 'Instalasi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/prlab'],],	
							['label' => 'Instalasi Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/pradiologi'],],	
							['label' => 'Unit Farmasi',
								'icon' => 'fas  fa-user-md',
								'url' => '#',
								'items' => [
									['label' => 'Formularium', 'icon' => 'fas fa-medkit', 'url' => ['/gelang'],],
									['label' => 'Waktu tunggu obat', 'icon' => 'fas fa-medkit ', 'url' => ['/transferpasien'],],
									['label' => 'Obat Racikan', 'icon' => 'fas fa-medkit ', 'url' => ['/'],],	
								
								]
								],
							['label' => 'Unit Rawat Inap',
								'icon' => 'fas  fa-bed',
								'url' => '#',
								'items' => [
									['label' => 'Keperawatan',
									'icon' => 'fas fa-user-md',
									'url' => '#',
									'items' => [
									['label' => 'Clinical Pathway', 'icon' => 'fas fa-medkit', 'url' => ['/'],],
									['label' => 'Hand hygine', 'icon' => 'fas fa-medkit ', 'url' => ['/'],],
									['label' => 'Penggunaan APD', 'icon' => 'fas fa-medkit ', 'url' => ['/'],],	
									['label' => 'Pengisian EWS', 'icon' => 'fas fa-medkit ', 'url' => ['/'],],	
								
									]
									],
									['label' => 'Kebidanan',
									'icon' => 'fas fa-user-md',
									'url' => '#',
									'items' => [
									['label' => 'Keterlambatan SC', 'icon' => 'fas fa-medkit', 'url' => ['/'],],
									['label' => 'Keterlambatan Darah', 'icon' => 'fas fa-medkit ', 'url' => ['/'],],
									['label' => 'Kematian Ibu dan bayi', 'icon' => 'fas fa-medkit ', 'url' => ['/'],],	
									['label' => 'Angka IMD', 'icon' => 'fas fa-medkit ', 'url' => ['/'],],	
								
									]
									],
								
								]
								],
							
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
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'Orderlab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab/orderlab'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
			$rad =
					[
						'label' => 'Radiologi',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/radiologi'],],
							
							['label' => 'Order Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/radiologi/listrad'],],
							['label' => 'Create Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/radtemplate'],],
							['label' => 'Create Radiologi Luar', 'icon' => 'fas fa-ambulance ', 'url' => ['/radiologi/indexmcu'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
					$usg =
					[
						'label' => 'Ultrasonografi',
						'icon' => 'fas  fa-asterisk',
						'url' => '#',
						'items' => [
							['label' => 'List USG', 'icon' => 'fas fa-ambulance ', 'url' => ['/usg'],],
							
							['label' => 'List Template', 'icon' => 'fas fa-ambulance ', 'url' => ['/temusg'],],
							['label' => 'List Layanan', 'icon' => 'fas fa-ambulance ', 'url' => ['/dafusg'],],
							
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
							

}
//admin
else if(Yii::$app->user->identity->idpriv == 2){
		$rad=[];
		$usg=[];
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
							['label' => 'Bor Los Toi', 'icon' => 'fas fa-h-square', 'url' => ['/borlostoi'],],
							
						],
						
						
					];
		$online =
					[
						'label' => 'Data Online',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien Daftar Online', 'icon' => 'fas fa-cart-plus', 'url' => ['/pasienonline'],],
							['label' => 'Kuota', 'icon' => 'fas fa-cart-plus', 'url' => ['/daftar-online'],],
							['label' => 'Statistik', 'icon' => 'fas fa-user-md', 'url' => ['/dokter'],],
							
							
						],
						
					];
		$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

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
							['label' => 'Laporan', 'icon' => 'fa fa-cart-plus', 'url' => ['apotek/laporan-harian'],],
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
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi2'],],
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak2'],],
							['label' => 'Poli Bedah', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polibedah2'],],
							['label' => 'Poli Kandungan', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polikandungan2'],],
							['label' => 'Poli Penyakit Dalam', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polidalam2'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$igd =
					[
						'label' => 'IGD',
						'icon' => 'fas fa-ambulance',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd2'],],
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
						['label' => 'Area Klinik',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'AREA KLINIK 1', 'icon' => 'fas fa-ambulance ', 'url' => ['/asesmenpasien'],],
							['label' => 'AREA KLINIK 2', 'icon' => 'fas fa-ambulance ', 'url' => ['/ert'],],
							['label' => 'AREA KLINIK 3', 'icon' => 'fas fa-ambulance ', 'url' => ['/antibiotik'],],	
							['label' => 'AREA KLINIK 4', 'icon' => 'fas fa-ambulance ', 'url' => ['/rmugd'],],	
							['label' => 'AREA KLINIK 5', 'icon' => 'fas fa-ambulance ', 'url' => ['/apd'],],	
							['label' => 'AREA KLINIK 6', 'icon' => 'fas fa-ambulance ', 'url' => ['/cp'],],	
						]
						],
						//area sasaran
						['label' => 'Area SKP',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'SKP 1', 'icon' => 'fas fa-ambulance ', 'url' => ['/gelang'],],
							['label' => 'SKP 2', 'icon' => 'fas fa-ambulance ', 'url' => ['/transferpasien'],],
							['label' => 'SKP 3', 'icon' => 'fas fa-ambulance ', 'url' => ['/'],],	
							['label' => 'SKP 4', 'icon' => 'fas fa-ambulance ', 'url' => ['/prosm'],],	
							['label' => 'SKP 5', 'icon' => 'fas fa-ambulance ', 'url' => ['/cuciigd'],],	
							['label' => 'SKP 6', 'icon' => 'fas fa-ambulance ', 'url' => ['/karj'],],	
						]
						]
						
						]
						],
						['label' => 'PMKP (Indikator Unit)',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Unit Gawat Darurat', 'icon' => 'fas fa-ambulance ', 'url' => ['/indikatorigd'],],
							['label' => 'Unit Rekam Medis', 'icon' => 'fas fa-ambulance ', 'url' => ['/inaprm'],],
							['label' => 'Instalasi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/prlab'],],	
							['label' => 'Instalasi Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/pradiologi'],],	
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
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'Orderlab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab/orderlab'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
		$perawat=[];
		$gudang=[];
		$usg=[];
							

}
//rekamedis
else if(Yii::$app->user->identity->idpriv == 3){
	$rad=[];
	$usg=[];
	$datamaster =
					[
						'label' => 'Data Master',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien', 'icon' => 'fas fa-cart-plus', 'url' => ['/pasien/index'],],
							['label' => 'Cek Kepesertaan BPJS', 'icon' => 'fas fa-user-md', 'url' => ['/bpjs/cek-peserta'],],
							['label' => 'Data Rawat', 'icon' => 'fas fa-h-square', 'url' => ['/rawatjalan/laporanrawat'],],
							['label' => 'Rujukan', 'icon' => 'fas fa-h-square', 'url' => ['/rujukan'],],
							['label' => 'Surat Sakit', 'icon' => 'fas fa-h-square', 'url' => ['/suratsakit'],],
							
						],
						
					];
	$online =
					[
						'label' => 'Data Online',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien Daftar Online', 'icon' => 'fas fa-cart-plus', 'url' => ['/pasienonline'],],
							['label' => 'Kuota', 'icon' => 'fas fa-cart-plus', 'url' => ['/daftar-online'],],
							['label' => 'Statistik', 'icon' => 'fas fa-user-md', 'url' => ['/dokter'],],
							
							
						],
						
					];
	$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$apotek=[
						'label' => 'Status Rekamedis',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Status Keluar', 'icon' => 'fas fa-cart-plus', 'url' => ['/rekamedis'],],

						],
						
					];;
	$gudang=[];
	$cassa=[];
	$poli=[];
	$igd=[];
	$lab=[
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
	$ppi=[];
	$pmkp=[];
	$statistik=[	'label' => 'KlPCM',
						'url' => '#',
						'items' => [
							['label' => 'KLPCM Ranap', 'icon' => 'fas fa-cart-plus', 'url' => ['/klpcm'],],
							['label' => 'KLPCM Rajal', 'icon' => 'fas fa-cart-plus', 'url' => ['/klpcmrajal'],],
							['label' => 'KLPCM UGD', 'icon' => 'fas fa-cart-plus', 'url' => ['/klpcmugd'],],

						],
						
					];
	$perawat=[];

}
//Gudang
else if(Yii::$app->user->identity->idpriv == 18){
	$rad=[];
	$datamaster =[];
	$online =[];
	$usg=[];
	$apotek=[];
			$gudang =[
			'label' => 'Gudang',
			'icon' => 'fas fa-medkit',
			'url' => '#',
			'items' => [
				['label' => 'Data Barang', 'icon' => 'fa fa-file-o', 'url' => ['/gudang'],],
				['label' => 'Distribusi', 'icon' => 'fa fa-file-o', 'url' => ['/gudang/distribusi'],],
				['label' => 'Pembelian', 'icon' => 'fa fa-file-o', 'url' => ['/gudang/pembelian'],],
				['label' => 'Data Pembelian', 'icon' => 'fa fa-file-o', 'url' => ['/gudang/datapembelian'],],
				['label' => 'Mutasi Stok', 'icon' => 'fa fa-file-o', 'url' => ['/gudang/mutasistok'],],
				
			],
			
		];
	$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$cassa=[];
	$poli=[];
	$igd=[];
	$lab=[];
	$ppi=[];
	$pmkp=[];
	$statistik=[];
	$perawat=[];
	$usg=[];

}
//Apotik
else if(Yii::$app->user->identity->idpriv == 5){
	$rad=[];
	$datamaster=[];
	$online=[];
	$jurnal=[];
	$usg=[];
$apotek =[
						'label' => 'Farmasi',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Antrian Apotek', 'icon' => 'fa fa-cart-plus', 'url' => ['/resep'],],
							['label' => 'Apotek Umum (Luar)', 'icon' => 'fa fa-cart-plus', 'url' => ['/apotekumum'],],
							['label' => 'Apotek Unit', 'icon' => 'fa fa-cart-plus', 'url' => ['/apotek-unit'],],
							['label' => 'Laporan', 'icon' => 'fa fa-cart-plus', 'url' => ['/apotek/laporan-harian'],],
							['label' => 'Data Obat', 'icon' => 'fa fa-file-o', 'url' => ['/apotek'],],
							
						],
						
					];
					
	$cassa=[];
	$poli=[];	
	$gudang=[];
	$igd=[];	
	$lab=[];	
	$ppi=[];
	$pmkp=[];
	$statistik=[];	
	$perawat=[];
	
}
//kasir
else if(Yii::$app->user->identity->idpriv == 6){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$usg=[];
	$cassa =[
						'label' => 'Cassa',
						'icon' => 'fas fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'Antrian Pembayaran', 'icon' => 'fas fa-cart-plus', 'url' => ['/cassa'],],
							['label' => 'Laporan Harian', 'icon' => 'fas fa-file-o', 'url' => ['/yanmas'],],
							['label' => 'Tarif', 'icon' => 'fas fa-file-o', 'url' => ['/tarif'],],
							
						],
						
					];
	$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
	];
	$poli=[];	
	$igd=[];
	$gudang=[];
	$lab=[];
	$ppi=[];
	$statistik=[];
	$pmkp=[];
	$perawat=[];
}
//perawat
else if(Yii::$app->user->identity->idpriv == 7){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$cassa=[];
	$poli=[];	
	$usg=[];
	$igd=[];
	$perawat =
					[
						'label' => 'Data Keperawatan',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien', 'icon' => 'fas fa-cart-plus', 'url' => ['/keperawatan'],],
							
							
						],
						
					];
	$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$lab=[];
	$gudang=[];
	$ppi=[];
	$statistik=[];
	$pmkp=[];
}
//perawatpoli
else if(Yii::$app->user->identity->idpriv == 8){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$usg=[];
	$cassa=[];
	$poli =
					[
						'label' => 'Poli',
						'icon' => 'fas fa-heartbeat',
						'url' => '#',
						'items' => [
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi2'],],
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak2'],],
							['label' => 'Poli Bedah', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polibedah2'],],
							['label' => 'Poli Kandungan', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polikandungan2'],],
							['label' => 'Poli Penyakit Dalam', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polidalam2'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
			$igd =
					[
						'label' => 'IGD',
						'icon' => 'fas fa-ambulance',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd2'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$lab=[];
	$ppi=[];
	$statistik=[
						'label' => 'Jadwal Operasi',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jadwal Operasi', 'icon' => 'fas fa-cart-plus', 'url' => ['/jadwaloperasi'],],

						],
						
					];
	$pmkp=[];
	$gudang=[];
	$perawat=[];
	
}
//perawatigd
else if(Yii::$app->user->identity->idpriv == 9){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$cassa=[];
	$usg=[];
	$poli=[];
	$igd =
					[
						'label' => 'IGD',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd2'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$lab=[];
	$ppi=[];
	$statistik=[];
	$pmkp=[];
	$gudang=[];
	$perawat=[];
}
//ipclnigd
else if(Yii::$app->user->identity->idpriv == 10 ){
	$rad=[];
	$datamaster=[];
	$online =[];
	$usg=[];
	$apotek=[];
	$cassa=[];
	$poli=[];
	$perawat=[];
	$igd =
					[
						'label' => 'IGD',
						'icon' => 'fa fa-shopping-cart',
						'url' => '#',
						'items' => [
							['label' => 'IGD', 'icon' => 'fa fa-cart-plus', 'url' => ['/rawatjalan/igd2'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$lab=[];
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
	$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$statistik=[];
	$pmkp=[];
	$gudang=[];
}
//ipclnRi
else if(Yii::$app->user->identity->idpriv == 11){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$cassa=[];
	$poli=[];
	$usg=[];
	$igd =[];
	$lab=[];
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
	$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$statistik=[];
	$pmkp=[];
	$gudang=[];
	$perawat=[];
}
//IPCLNPoli
else if(Yii::$app->user->identity->idpriv == 12){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$usg=[];
	$perawat='';
	$cassa=[];
	$poli =
					[
						'label' => 'Poli',
						'icon' => 'fas fa-heartbeat',
						'url' => '#',
						'items' => [
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi2'],],
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak2'],],
							['label' => 'Poli Bedah', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polibedah2'],],
							['label' => 'Poli Kandungan', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polikandungan2'],],
							['label' => 'Poli Penyakit Dalam', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polidalam2'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$igd =[];
	$lab=[];
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
	$statistik=[];
	$pmkp=[];
	$gudang=[];
}
//IPCLN LAB
else if(Yii::$app->user->identity->idpriv == 13){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$cassa=[];
	$poli= [];
	$perawat=[];
	$igd =[];
	$lab =
					[
						'label' => 'Laboratorium',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'Orderlab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab/orderlab'],],
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
		$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$statistik=[];
	$pmkp=[];
	$gudang=[];
}
//OK
else if(Yii::$app->user->identity->idpriv == 14){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$cassa=[];
	$poli= [];
	$perawat=[];
	$igd =[];
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
		$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$statistik=[];
	$pmkp=[];
	$gudang=[];
}
//Radiologi
else if(Yii::$app->user->identity->idpriv == 20){
	$datamaster =[	'label' => 'Data Master',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Data Pasien', 'icon' => 'fas fa-cart-plus', 'url' => ['/pasien/index'],],
						],
						
					];
	$online =[];
	$apotek=[];
	$cassa=[];
	$poli= [];
	$igd =[];
	$rad =
					[
						'label' => 'Radiologi',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/radiologi'],],
							
							['label' => 'Order Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/radiologi/listrad'],],
							['label' => 'Create Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/radtemplate'],],
							['label' => 'Create Radiologi Luar', 'icon' => 'fas fa-ambulance ', 'url' => ['/radiologi/indexmcu'],],
							['label' => 'MCU TNI', 'icon' => 'fas fa-ambulance ', 'url' => ['/mcutni'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$usg =
					[
						'label' => 'Ultrasonografi',
						'icon' => 'fas  fa-asterisk',
						'url' => '#',
						'items' => [
							['label' => 'List USG', 'icon' => 'fas fa-ambulance ', 'url' => ['/usg'],],
							
							['label' => 'List Template', 'icon' => 'fas fa-ambulance ', 'url' => ['/temusg'],],
							['label' => 'List Layanan', 'icon' => 'fas fa-ambulance ', 'url' => ['/dafusg'],],
							
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
					$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$lab =[];
	$ppi =[];
	$statistik=[];
	$pmkp=[];
	$gudang=[];
	$perawat=[];
}
//Lab
else if(Yii::$app->user->identity->idpriv == 16){
	$gudang=[];
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$cassa=[];
	$poli= [];
	$usg= [];
	$igd =[];
	$rad=[];
	$lab =
					[
						'label' => 'Laboratorium',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Daftar Request Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab'],],
							['label' => 'List Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab/listlab'],],
							['label' => 'Orderlab', 'icon' => 'fas fa-ambulance ', 'url' => ['/lab/orderlab'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
					$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

						],
						
					];
	$ppi =[];
	$statistik=[];
	$pmkp=[];
	$perawat=[];
}
else if(Yii::$app->user->identity->idpriv == 17){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$cassa=[];
	$poli= [];
	$igd =[];
	$perawat=[];
	$lab =[];
	$ppi =[];
	$statistik=[];
	$jurnal =
					[
						'label' => 'Data Jurnal',
						'icon' => 'fas fa-database',
						'url' => '#',
						'items' => [
							['label' => 'Jurnal', 'icon' => 'fas fa-cart-plus', 'url' => ['/dokumen'],],

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
						['label' => 'Area Klinik',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'AREA KLINIK 1', 'icon' => 'fas fa-ambulance ', 'url' => ['/asesmenpasien'],],
							['label' => 'AREA KLINIK 2', 'icon' => 'fas fa-ambulance ', 'url' => ['/ert'],],
							['label' => 'AREA KLINIK 3', 'icon' => 'fas fa-ambulance ', 'url' => ['/antibiotik'],],	
							['label' => 'AREA KLINIK 4', 'icon' => 'fas fa-ambulance ', 'url' => ['/rmugd'],],	
							['label' => 'AREA KLINIK 5', 'icon' => 'fas fa-ambulance ', 'url' => ['/apd'],],	
							['label' => 'AREA KLINIK 6', 'icon' => 'fas fa-ambulance ', 'url' => ['/cp'],],	
						]
						],
						//area sasaran
						['label' => 'Area SKP',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'SKP 1', 'icon' => 'fas fa-ambulance ', 'url' => ['/gelang'],],
							['label' => 'SKP 2', 'icon' => 'fas fa-ambulance ', 'url' => ['/transferpasien'],],
							['label' => 'SKP 3', 'icon' => 'fas fa-ambulance ', 'url' => ['/'],],	
							['label' => 'SKP 4', 'icon' => 'fas fa-ambulance ', 'url' => ['/prosm'],],	
							['label' => 'SKP 5', 'icon' => 'fas fa-ambulance ', 'url' => ['/cuciigd'],],	
							['label' => 'SKP 6', 'icon' => 'fas fa-ambulance ', 'url' => ['/karj'],],	
						]
						]
						
						]
						],
						['label' => 'PMKP (Indikator Unit)',
						'icon' => 'fas  fa-user-md',
						'url' => '#',
						'items' => [
							['label' => 'Unit Gawat Darurat', 'icon' => 'fas fa-ambulance ', 'url' => ['/indikatorigd'],],
							['label' => 'Unit Rekam Medis', 'icon' => 'fas fa-ambulance ', 'url' => ['/inaprm'],],
							['label' => 'Instalasi Lab', 'icon' => 'fas fa-ambulance ', 'url' => ['/prlab'],],	
							['label' => 'Instalasi Radiologi', 'icon' => 'fas fa-ambulance ', 'url' => ['/pradiologi'],],	
							['label' => 'Instalasi Farmasi', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
							['label' => 'Instalasi Kamar Oprasi', 'icon' => 'fas fa-ambulance ', 'url' => ['/#'],],	
						]
						]
							
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];

}
else if(Yii::$app->user->identity->idpriv == 21){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$cassa=[];
	$poli= [];
	$igd =[];
	$usg =[];
	$perawat=[];
	$lab =[];
	$ppi =[];
	$jurnal =[];
	$statistik=[];
	$pmkp =[];
	$gudang =[];
}else if(Yii::$app->user->identity->idpriv == 4){
	$rad=[];
	$datamaster=[];
	$online =[];
	$apotek=[];
	$cassa=[];
	$poli =
					[
						'label' => 'Poli',
						'icon' => 'fas fa-heartbeat',
						'url' => '#',
						'items' => [
							['label' => 'Poli Gigi', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/poligigi2'],],
							['label' => 'Poli Anak', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polianak2'],],
							['label' => 'Poli Bedah', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polibedah2'],],
							['label' => 'Poli Kandungan', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polikandungan2'],],
							['label' => 'Poli Penyakit Dalam', 'icon' => 'fa fa-cart-plus', 'url' => ['/poli/polidalam2'],],
							//['label' => 'Poli Anak ', 'icon' => 'fa fa-file-o', 'url' => ['/purchaseorder/index'],],
							
						],
						
					];
	$igd =[];
	$perawat=[];
	$usg=[];
	$lab =[];
	$ppi =[];
	$jurnal =[];
	$statistik=[];
	$pmkp =[];
	$gudang =[];
}

?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
					
					['label' => 'Dashboard', 'icon' => 'fas fa-hospital-o', 'url' => ['/'],],
					
						$datamaster,	
						$online,
						$rad,						
						$jurnal,						
						$apotek,
						$gudang,
						$cassa,
						$poli,
						$igd,
						$lab,
						$usg,
						$ppi,
						$perawat,
						$pmkp,
						$statistik,
				
					
				
				
                ],
            ]
        ) ?>

    </section>

</aside>
