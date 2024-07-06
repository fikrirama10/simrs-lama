<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\Jenisbayar;
/* @var $this yii\web\View */
/* @var $model common\models\BarangMasuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-masuk-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label('Tanggal');?>
    <?= $form->field($model, 'faktur')->textInput() ?>
	<?= $form->field($model, 'jenisbarang')->dropDownList(ArrayHelper::map(Jenisbayar::find()->where(['between','id',4,5])->all(), 'id', 'jenisbayar'))->label(false)?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
