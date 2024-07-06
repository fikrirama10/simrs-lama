<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
$pass = Yii::$app->user->identity->password_repeat;
?>
<div class='box box-body'>
	<h4><?= $model->pasien->sbb ?>, <?= $model->pasien->nama_pasien?> ( <?= $model->pasien->jenis_kelamin?> )</h4>
	<a style='color:grey;'>RM: <?= $model->no_rekmed ?> <b>|</b> No Rawat: <?= $model->idrawat?></a>
	<h6><?= $model->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($model->pasien->tanggal_lahir)) ?> ,<?=$model->pasien->usia?> th</h6>
	<hr>
	<a style='color:grey;'><?= $model->pasien->alamat?></a><br>
	<a style='color:grey;'><?= $model->pasien->nohp?></a><br>
	<hr>
	<?php $form = ActiveForm::begin(); ?>
	<?= $form->field($batal, 'ket')->textarea(['rows'=>4,'required'=>true])->label('Keterangan Batal'); ?>
	<?= Html::submitButton('Batal Berobat', ['class' => 'btn btn-danger','id'=>'confirm']) ?>
	<?php ActiveForm::end(); ?>
</div>

<?php 

$this->registerJs("

$('#confirm').on('click', function(event){
	age =  prompt('Masukan Kode Verifikasi?', );
	if(age == '{$pass}'){
       return true;
    } else {
        event.preventDefault();
        alert('Password salah');
    }
});

", View::POS_READY);
?>