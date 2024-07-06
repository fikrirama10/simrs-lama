	<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use kartik\date\DatePicker;

?>

<div class='row'>
	<div class='col-md-6'>
		<div class='box box-body'>
			<h3>Return Barang</h3>
			<hr>
			<h4><?= $resep->obat->namaobat ?> </h4>
			<?php $form = ActiveForm::begin(); ?>
				<?= $form->field($retur, 'qty')->textInput(['maxlength' => true,'rows'=>3])->label('Jumlah Retur') ?>
			<?= Html::submitButton('Simpan', ['class' => 'btn btn-success btn-sm ','id'=>'confirm']) ?>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
<?php 
$this->registerJs("

$('#confirm').on('click', function(event){
	age =  prompt('Masukan Kode Verifikasi?', );
	if(age == '112233'){
       return true;
    } else {
        event.preventDefault();
        return false;
    }
});

", View::POS_READY);
?>