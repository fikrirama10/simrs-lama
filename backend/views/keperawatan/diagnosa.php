<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use common\models\Articles;
use yii\helpers\Url;
use yii\web\View;
use common\models\StatusHub;
use common\models\Provinsi;
use common\models\Kelurahan;
use common\models\Kabupaten;
use common\models\Kecamatan;
use common\models\Suku;
use common\models\Pendidikan;
use common\models\Jenispekerjaan;
use kartik\date\DatePicker;
$t1=0;
$url = 'https://simrs.rsausulaiman.com/api/icd10';
        $content = file_get_contents($url);
        $json = json_decode($content, true);
$url2 = 'https://simrs.rsausulaiman.com/api/icd10anak';
        $ank = file_get_contents($url2);
        $json2 = json_decode($ank, true);
$url3 = 'https://simrs.rsausulaiman.com/api/icd10bedah';
        $bdh = file_get_contents($url3);
        $json3 = json_decode($bdh, true);

$icd01 = 'https://simrs.rsausulaiman.com/api/icd10ana01';
        $icdnol = file_get_contents($icd01);
        $nolsatu = json_decode($icdnol, true);

$icd41 = 'https://simrs.rsausulaiman.com/api/icd10ana41';
        $icdempat = file_get_contents($icd41);
        $empatsatu = json_decode($icdempat, true);
		
$icd514 = 'https://simrs.rsausulaiman.com/api/icd10ana514';
        $limaempat = file_get_contents($icd514);
        $empatlima = json_decode($limaempat, true);
$icd1544 = 'https://simrs.rsausulaiman.com/api/icd10ana1544';
        $belas4 = file_get_contents($icd1544);
        $limabelas = json_decode($belas4, true);
$icd14575 = 'https://simrs.rsausulaiman.com/api/icd10ana4575';
        $tujuhlima = file_get_contents($icd14575);
		$limatujuh = json_decode($tujuhlima, true);
/* @var $this yii\web\View */
$no=1;
/* @var $model common\models\Pasisen */
/* @var $form yii\widgets\ActiveForm */

?>
<div class='box box-body'>
<h3>10 Besar Diagnosa Rawat Inap</h3>
<table class='table table-bordered'>
	<tr>
		
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 20; $a++){ ?>
		<tr>
		<td><?= $json[$a]['Diagnosa'] ?></td>
		<td><?= $json[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
</table>
</div>
<div class='box box-body'>
<h3>10 Besar Diagnosa Rawat Inap Anak</h3>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 20; $a++){ ?>
		<tr>
		<td><?= $no++ ?></td>
		<td><?= $json2[$a]['Diagnosa'] ?></td>
		<td><?= $json2[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
</table>
</div>
<div class='box box-body'>
<h3>10 Besar Diagnosa Rawat Inap Bedah</h3>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 10; $a++){ ?>
		<tr>
		<td><?= $no++ ?></td>
		<td><?= $json3[$a]['Diagnosa'] ?></td>
		<td><?= $json3[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
</table>
</div>

<div class='box box-body'>
<h3>0 - 1 tahun </h3>
<table class='table table-bordered'>
	<tr>
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 20; $a++){ ?>
		<tr>
		<td><?= $nolsatu[$a]['Diagnosa'] ?></td>
		<td><?= $nolsatu[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
	
</table>
</div>

<div class='box box-body'>
<h3>1 - 4 tahun </h3>
<table class='table table-bordered'>
	<tr>
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 20; $a++){ ?>
		<tr>
		<td><?= $empatsatu[$a]['Diagnosa'] ?></td>
		<td><?= $empatsatu[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
	
</table>
</div>
<div class='box box-body'>
<h3>5 - 14 tahun </h3>
<table class='table table-bordered'>
	<tr>
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 20; $a++){ ?>
		<tr>
		<td><?= $empatlima[$a]['Diagnosa'] ?></td>
		<td><?= $empatlima[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
	
</table>
</div>
<div class='box box-body'>
<h3>14 - 44 tahun </h3>
<table class='table table-bordered'>
	<tr>
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 20; $a++){ ?>
		<tr>
		<td><?= $limabelas[$a]['Diagnosa'] ?></td>
		<td><?= $limabelas[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
	
</table>
</div>
<div class='box box-body'>
<h3>45 - 75 tahun </h3>
<table class='table table-bordered'>
	<tr>
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 20; $a++){ ?>
		<tr>
		<td><?= $limatujuh[$a]['Diagnosa'] ?></td>
		<td><?= $limatujuh[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
	
</table>
</div>