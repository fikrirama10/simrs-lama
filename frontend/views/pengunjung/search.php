	<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use dosamigos\chartjs\ChartJs;
use kartik\grid\GridView;
use common\models\Pasien;
use yii\helpers\Url;
// $yanmas = Pasien::find()->where(['between','idpekerjaan',5,11])->count();
// $yanmasbaru = Pasien::find()->where(['between','idpekerjaan',5,11])->andwhere(['stpasien'=>'Baru'])->count();
// $yanmaslama = Pasien::find()->where(['between','idpekerjaan',5,11])->andwhere(['stpasien'=>'Old'])->count();

// $jumlah = Pasien::find()->count();
// $jumlahbaru = Pasien::find()->where(['stpasien'=>'Baru'])->count();
// $jumlahlama = Pasien::find()->where(['stpasien'=>'Old'])->count();

// $pur = Pasien::find()->where(['idpekerjaan'=>13])->count();
// $purbaru = Pasien::find()->where(['idpekerjaan'=>13])->andwhere(['stpasien'=>'Baru'])->count();
// $purlama = Pasien::find()->where(['idpekerjaan'=>13])->andwhere(['stpasien'=>'Old'])->count();
// TNI AU
// $tniaumilall = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->count();
// $tniausipall = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Sip'])->count();
// $tniaukelall = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Kel'])->count();
// $tniaumilbaru = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
// $tniausipbaru = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Baru'])->count();
// $tniaukelbaru = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Baru'])->count();
// $tniaumillama = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
// $tniausiplama = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Old'])->count();
// $tniaukellama = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Old'])->count();
// TNI AD
// $tniadmilall = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->count();
// $tniadsipall = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Sip'])->count();
// $tniadkelall = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Kel'])->count();
// $tniadmilbaru = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
// $tniadsipbaru = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Baru'])->count();
// $tniadkelbaru = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Baru'])->count();
// $tniadmillama = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
// $tniadsiplama = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Old'])->count();
// $tniadkellama = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Old'])->count();

// TNI AL
// $tnialmilall = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->count();
// $tnialsipall = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Sip'])->count();
// $tnialkelall = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Kel'])->count();
// $tnialmilbaru = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
// $tnialsipbaru = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Baru'])->count();
// $tnialkelbaru = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Baru'])->count();
// $tnialmillama = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
// $tnialsiplama = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Old'])->count();
// $tnialkellama = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Old'])->count();
// polri
// $polrimilall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->count();
// $polrisipall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sip'])->count();
// $polrikelall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Kel'])->count();
// $polrimilbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
// $polrisipbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Baru'])->count();
// $polrikelbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Baru'])->count();
// $polrimillama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
// $polrisiplama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Old'])->count();
// $polrikellama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Old'])->count();


?>
<div class='container-fluid' style='background:#fff;'>
				
	<div class='row'>
		<div class='col-md-12'>
			<div class='row'>
				<div class='box box-body'>
				<table class='table table-bordered' style='text-align:center;'>
				<tr >
					<th align=center rowspan="2">Pengunjung / Kunjungan</th>
					
					<th colspan="3">TNI AU</th>
					<th colspan="3">TNI AD</th>
					<th colspan="3">TNI AL</th>
					<th colspan="3">POLRI</th>
					<th align=center rowspan="2">PUR</th>
					<th align=center rowspan="2">BPJS /<br> Yanmas</th>
					<th align=center rowspan="2">Jumlah</th>
				</tr>
				<tr>
					<!-- TNI AU -->
					<th scope="col">Mil</th>
					<th scope="col">Sip</th>
					<th scope="col">Kel</th>
					<!-- TNI AD -->
					<th scope="col">Mil</th>
					<th scope="col">Sip</th>
					<th scope="col">Kel</th>
					<!-- TNI AL -->
					<th scope="col">Mil</th>
					<th scope="col">Sip</th>
					<th scope="col">Kel</th>
					<!-- polri -->
					<th scope="col">Mil</th>
					<th scope="col">Sip</th>
					<th scope="col">Kel</th>
					
				</tr>
				<tr>
				<th id="navi" scope="row">Pengunjung</th>
				<!-- TNI AU -->
				<td headers="team navi win score"><?= $tniaumilall?></td>
				<td headers="team navi draw score"><?= $tniausipall?></td>
				<td headers="team navi lost score"><?= $tniaukelall?></td>
				<!-- TNI AD -->
				<td headers="team navi win score"><?= $tniadmilall?></td>
				<td headers="team navi draw score"><?= $tniadsipall?></td>
				<td headers="team navi lost score"><?= $tniadkelall?></td>
				<!-- TNI AL -->
				<td headers="team navi win score"><?= $tnialmilall?></td>
				<td headers="team navi draw score"><?= $tnialsipall?></td>
				<td headers="team navi lost score"><?= $tnialkelall?></td>
				<!-- POLRI -->
				<td headers="team navi win score"><?= $polrimilall?></td>
				<td headers="team navi draw score"><?= $polrisipall?></td>
				<td headers="team navi lost score"><?= $polrikelall?></td>
				<!-- PUR -->
				<td headers="team navi win score"><?= $pur?></td>
				<td headers="team navi win score"><?= $yanmas?></td>
				<td headers="team navi win score"><?= $jumlah?></td>
				
				</tr>
				<tr>
				<th id="navi" scope="row">Kunjungan Baru</th>
					<!-- TNI AU -->
				<td headers="team navi win score"><?= $tniaumilbaru?></td>
				<td headers="team navi draw score"><?= $tniausipbaru?></td>
				<td headers="team navi lost score"><?= $tniaukelbaru?></td>
				<!-- TNI AD -->
				<td headers="team navi win score"><?= $tniadmilbaru?></td>
				<td headers="team navi draw score"><?= $tniadsipbaru?></td>
				<td headers="team navi lost score"><?= $tniadkelbaru?></td>
				<!-- TNI AL -->
				<td headers="team navi win score"><?= $tnialmilbaru?></td>
				<td headers="team navi draw score"><?= $tnialsipbaru?></td>
				<td headers="team navi lost score"><?= $tnialkelbaru?></td>
				<!-- POLRI -->
				<td headers="team navi win score"><?= $polrimilbaru?></td>
				<td headers="team navi draw score"><?= $polrisipbaru?></td>
				<td headers="team navi lost score"><?= $polrikelbaru?></td>
					<!-- PUR -->
				<td headers="team navi win score"><?= $purbaru?></td>
				<td headers="team navi win score"><?= $yanmasbaru?></td>
				<td headers="team navi win score"><?= $jumlahbaru?></td>
				</tr>
				<tr>
				<th id="navi" scope="row">Kunjungan Ulang</th>
					<!-- TNI AU -->
					<!-- TNI AU -->
				<td headers="team navi win score"><?= $tniaumillama?></td>
				<td headers="team navi draw score"><?= $tniausiplama?></td>
				<td headers="team navi lost score"><?= $tniaukellama?></td>
				<!-- TNI AD -->
				<td headers="team navi win score"><?= $tniadmillama?></td>
				<td headers="team navi draw score"><?= $tniadsiplama?></td>
				<td headers="team navi lost score"><?= $tniadkellama?></td>
				<!-- TNI AL -->
				<td headers="team navi win score"><?= $tnialmillama?></td>
				<td headers="team navi draw score"><?= $tnialsiplama?></td>
				<td headers="team navi lost score"><?= $tnialkellama?></td>
				<!-- POLRI -->
				<td headers="team navi win score"><?= $polrimillama?></td>
				<td headers="team navi draw score"><?= $polrisiplama?></td>
				<td headers="team navi lost score"><?= $polrikellama?></td>
					<!-- PUR -->
				<td headers="team navi win score"><?= $purlama?></td>
				<td headers="team navi win score"><?= $yanmaslama?></td>
				<td headers="team navi win score"><?= $jumlahlama?></td>
				</tr>
		
				</table>
				<br>
		
				</div>
			</div>
		</div>
	
</div>