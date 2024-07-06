<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\DukkesSuplier;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\DukkesMasuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dukkes-masuk-form box box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idsuplier')->dropDownList(ArrayHelper::map(DukkesSuplier::find()->all(), 'id', 'suplier'),['prompt'=>'- Suplier -'])->label('',['class'=>'label-class'])->label('Suplier')?>

    <?=	$form->field($model, 'tgl')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label('Tanggal');?>

   

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
