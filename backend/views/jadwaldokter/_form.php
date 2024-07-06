<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Hari;
use common\models\Poli;
use common\models\Dokter;
use yii\helpers\ArrayHelper;
use kartik\time\TimePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Jadwaldokter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwaldokter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idhari')->dropDownList(ArrayHelper::map(Hari::find()->all(), 'id', 'nama_hari'),[
						'prompt'=>'- Pilih Hari -',])?>

	<?= $form->field($model, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'),[
						'prompt'=>'- Pilih Dokter -',])?>
	<?= $form->field($model, 'kuota')->textInput() ?>
	<?= $form->field($model, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->all(), 'id', 'namapoli'),[
							'prompt'=>'- Pilih Poli -',])?>

    <?= $form->field($model, 'mulaijam')->widget(TimePicker::classname(), [    'pluginOptions' => [
        'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 1,
        'secondStep' => 5,
    ]]); ?>

    <?= $form->field($model, 'selesaijam')->widget(TimePicker::classname(), [    'pluginOptions' => [
        'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 1,
        'secondStep' => 5,
    ]]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
