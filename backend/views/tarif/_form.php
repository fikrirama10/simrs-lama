<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Jenisbayar;
use common\models\Jenistarif;
use common\models\JenispenerimaanDetail;
/* @var $this yii\web\View */
/* @var $model common\models\Tarif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarif-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tarif')->textInput() ?>
   <?= $form->field($model, 'idjenis')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -'])->label('',['class'=>'label-class'])->label('Jenis Tarif')?>
   <?= $form->field($model, 'jenistarif')->dropDownList(ArrayHelper::map(Jenistarif::find()->all(), 'id', 'jenistarif'),['prompt'=>'- Pilih Jenis Tarif -'])->label('',['class'=>'label-class'])->label('Kategori Tarif')?>
   <?= $form->field($model, 'jenisterima')->dropDownList(ArrayHelper::map(JenispenerimaanDetail::find()->all(), 'id', 'namapenerimaan'),['prompt'=>'- Pilih Jenis Terima -'])->label('',['class'=>'label-class'])->label('Jenis Penerimaan')?>
   
    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
