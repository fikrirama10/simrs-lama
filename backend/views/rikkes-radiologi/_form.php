<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\RikkesRadiologi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rikkes-radiologi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namakegiatan')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jenis')->dropDownList([ 'CASIS' => 'CASIS', 'CATAM' => 'CATAM', ], ['prompt' => '']) ?>
    <?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
