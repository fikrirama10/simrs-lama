<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use common\models\Dafrad;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Pradiologi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pradiologi-form">

    <?php $form = ActiveForm::begin(); ?>

	<?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>
	
 
    <?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'jenispemeriksaan')->dropDownList(ArrayHelper::map(Dafrad::find()->all(), 'id', 'jenispemeriksaan'),[
						'prompt'=>'- Pilih Pemeriksaan -',])?>

    <?= $form->field($model, 'jamdiambil')->widget(TimePicker::classname(), [    'pluginOptions' => [
        'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 1,
        'secondStep' => 5,
    ]]); ?>

   <?= $form->field($model, 'jamhasil')->widget(TimePicker::classname(), [    'pluginOptions' => [
        'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 1,
        'secondStep' => 5,
    ]]); ?>

   
  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
