<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\Temusg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temusg-form">

    <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'judul')->textInput(['maxlength' => true,'class' => 'form-control bold']) ?>
    <?= $form->field($model, 'hasil')->widget(CKEditor::className(), [
					'options' => ['rows' => 6],
					'preset' => 'standard',
					'id'=>'hasil-usg'
				]) ?>
   <?= $form->field($model, 'kesimpulan')->widget(CKEditor::className(), [
					'options' => ['rows' => 6],
					'preset' => 'standard',
					'id'=>'kesimpulan-usg'
				]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
