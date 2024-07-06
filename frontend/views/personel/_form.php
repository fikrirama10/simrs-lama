<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Personel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->textInput() ?>

    <?= $form->field($model, 'nrp')->textInput()->label('NRP / NIP') ?>

    <?= $form->field($model, 'pangkat')->textInput(['maxlength' => true])->label('Pangkat / Golongan') ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label('Nama Lengkap') ?>

   <?=	$form->field($model, 'tgllahir')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label('Tanggal Lahir (Tahun - Bulan - Tanggal )');?>

    <?= $form->field($model, 'nohp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kepegawaian')->dropDownList([ 'TNI' => 'TNI', 'PNS' => 'PNS', 'Honorer' => 'Honorer', 'TKL' => 'TKL', ], ['prompt' => ''])->label('Status Kepegawaian') ?>

    <?= $form->field($model, 'profesi')->dropDownList([ 'Dokter Umum' => 'Dokter Umum', 'Dokter Gigi' => 'Dokter Gigi', 'Dokter Spesialis' => 'Dokter Spesialis', 'Perawat' => 'Perawat', 'Perawat Gigi' => 'Perawat Gigi', 'Bidan' => 'Bidan', 'Apoteker' => 'Apoteker', 'Administrasi' => 'Administrasi', 'Radiografer' => 'Radiografer', 'Analis' => 'Analis', 'Assisten Apoteker' => 'Assisten Apoteker', 'IT' => 'IT', 'Rekammedis' => 'Rekammedis', 'CS' => 'CS', 'CSSD' => 'CSSD', 'Juru Masak' => 'Juru Masak', 'Gizi' => 'Gizi', 'Kesling' => 'Kesling', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
