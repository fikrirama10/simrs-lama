<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Jenisbayar;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Pagu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagu-form">
	<div class="box box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jenispagu')->dropDownList(ArrayHelper::map(Jenisbayar::find()->where(['between','id',4,5])->all(), 'id', 'jenisbayar'))->label('Jenis Pagu')?>


    <?= $form->field($model, 'nilaipagu')->textInput()->label('Nilai Pagu') ?>
	<label>Tahun</label>
	<?php
	$now=date('Y');
	echo "<select class='form-control' id='pagu-tahun' name='Pagu[tahun]' id='start_date'>";
	for ($a=2021;$a<=$now;$a++)
	{
		 echo "<option  value='$a'>$a</option>";
	}
	echo "</select>";
	?>
	<hr>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

	</div>
</div>

