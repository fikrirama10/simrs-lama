<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\JenisDiagnosa;
use common\models\Dokter;
use yii\web\View;
use common\models\Poli;
use common\models\Kamar;
use yii\bootstrap\Modal;
use kartik\checkbox\CheckboxX;
?>
<table class='table table-success table-striped'>
	<tr>
		<th>Tgl</th>
		<th>No RM</th>
		<th>Nama</th>
		<th>Dokter</th>
	</tr>
	<?php foreach($rekmed as $r){ ?>
	<tr>
		<td><?= $r->tgldaftar ?></td>
		<td><a class='btn btn-default' id='<?= $r->id?>'><?= $r->no_rekmed ?></a><input type='hidden' value='<?= $r->id?>' id='golput<?= $r->id?>'></td>
		<td><?= $r->pasien->nama_pasien ?></td>
		<td>
		<?php if($r->idpoli == null){echo"<td></td>";}else{?>
		<?= $r->polii->namapoli ?>
		<?php } ?>
		</td>
	</tr>
	<?php 
	
	$urlGet = Url::to(['klpcmrajal/get-pasien']);
	$this->registerJs("
	
	$('#{$r->id}').on('click',function(){
		id = $('#golput{$r->id}').val();
			$.ajax({
			type: 'POST',
			url: '{$urlGet}',
			data: {id: id},
			dataType: 'json',
			success: function (data) {
				if(data !== null){
					$('#data-pasien').hide();
					var res = JSON.parse(JSON.stringify(data));
					
					$('#klpcm-idrajal').val(res.id);
					$('#klpcm-tanggal').val(res.tgldaftar);
					$('#diagnosa-tampil').val(res.kdiagnosa);
					
					
					
					//$('#transaksidetail-harga-disp').val(format_money(parseInt(harga),''));
					// console.log(kode +' '+ idstok);
				}else{
					alert('data tidak ditemukan');
				}
			},
			error: function (exception) {
				alert(exception);
			}
		});	
	}) ;


", View::POS_READY);

	?>
	<?php } ?>
</table>