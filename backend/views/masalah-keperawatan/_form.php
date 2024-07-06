<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MasalahKeperawatanKategori;
use common\models\MasalahKeperawatanSub;
use common\models\MasalahKeperawatanDiagnosa;
use common\models\MasalahKeperawatanTindakan;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\MasalahKeperawatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="masalah-keperawatan-form">

    <?php $form = ActiveForm::begin(); ?>

 

    <?= $form->field($model, 'idkategori')->dropDownList(ArrayHelper::map(MasalahKeperawatanKategori::find()->all(), 'id', 'kategori'),['prompt'=>'- Kategori Masalah -','onchange'=>'$.get("'.Url::toRoute('masalah-keperawatan/list-sub/').'",{ id: $(this).val() }).done(function( data ) 
	{
		  $( "select#masalahkeperawatan-idsub" ).html( data );
		});

	'])->label('Masalah Keperawatan')?>

    <?= $form->field($model, 'idsub')->dropDownList(ArrayHelper::map(MasalahKeperawatanSub::find()->where(['id'=>0])->all(), 'id', 'subkategori'),['prompt'=>'- Sub Kategori Masalah -','onchange'=>'$.get("'.Url::toRoute('masalah-keperawatan/list-diag/').'",{ id: $(this).val() }).done(function( data ) 
	{
		  $( "select#masalahkeperawatan-iddiagnosis" ).html( data );
		});

	'])->label('Kategori Masalah Keperawatan')?>

    <?= $form->field($model, 'iddiagnosis')->dropDownList(ArrayHelper::map(MasalahKeperawatanDiagnosa::find()->where(['id'=>0])->all(), 'id', 'diagnosis'),['prompt'=>'- Pilih Diagnosis -','onchange'=>'$.get("'.Url::toRoute('masalah-keperawatan/list-tind/').'",{ id: $(this).val() }).done(function( data ) 
	{
		  $( "select#masalahkeperawatan-idtindakan" ).html( data );
		});

	'])->label('Dokter',['class'=>'label-class'])->label('Diagnosis Masalah Keperawatan')?>
   
   <?= $form->field($model, 'idtindakan')->dropDownList(ArrayHelper::map(MasalahKeperawatanTindakan::find()->where(['id'=>0])->all(), 'id', 'tindakan'),['prompt'=>'- Pilih Tindakan -'])->label('Dokter',['class'=>'label-class'])->label('Kategori Diagnosis')?>


    <?= $form->field($model, 'tindakan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
