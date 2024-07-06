<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Jenisbayar;
/* @var $this yii\web\View */
/* @var $model common\models\PermintaanBarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permintaan-barang-form">
	<div class="box box-body">

    <?php $form = ActiveForm::begin(); ?>


    <?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label('Tanggal Permintaan');?>
   <?= $form->field($model, 'jenis')->dropDownList(ArrayHelper::map(Jenisbayar::find()->where(['between','id',4,5])->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenis Barang -','required'=>true])->label('Jenis Barang',['class'=>'label-class'])->label()?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

	</div>
</div>
