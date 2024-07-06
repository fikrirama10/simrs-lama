<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Daflab;
use yii\helpers\ArrayHelper;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Prlab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prlab-form">

    <?php $form = ActiveForm::begin(); ?>
		<?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>
    <?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'idjenis')->dropDownList(ArrayHelper::map(Daflab::find()->all(), 'id', 'namapemeriksaan'),[
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
