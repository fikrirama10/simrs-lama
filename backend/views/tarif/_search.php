<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Jenisbayar;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\TarifSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarif-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	<div class='row'>
		<div class='col-md-4'> <?= $form->field($model, 'nama') ?></div>
		<div class='col-md-4'><?= $form->field($model,'idjenis')->dropDownList(ArrayHelper::map(Jenisbayar::find()->where(['between','id',4,5])->all(),'id','jenisbayar'),['prompt'=>'- Pilih Jenis Tarif -'])->label('Jenis Tarif');?></div>
	</div>
   


   


    <?php // echo $form->field($model, 'ket') ?>

    <?php // echo $form->field($model, 'kode_tarif') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
