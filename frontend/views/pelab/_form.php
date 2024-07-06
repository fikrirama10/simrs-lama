<?php
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pelab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelab-form">

    <?php $form = ActiveForm::begin(); ?>

   	<?=	$form->field($model, 'tgl')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>

    <?= $form->field($model, 'rm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenispemeriksaan')->textInput() ?>

    <?= $form->field($model, 'jamdiambil')->widget(TimePicker::classname(), ['pluginOptions' => [
        'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 1,
        'secondStep' => 5,
    ]]); ?>

    <?= $form->field($model, 'jamhasil')->widget(TimePicker::classname(), ['pluginOptions' => [
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
