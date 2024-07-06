<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PasisenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasisen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	<div class='row'>
		<div class='col-md-6'>
			<div class='row'>
				<div class='col-xs-4'><?= $form->field($model, 'no_rekmed', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1','placeholder'=>'No Rekmed']])->label(false) ?></div>
				<div class='col-xs-4'><?= $form->field($model, 'nobpjs', ['inputOptions' => ['class' => 'form-control','placeholder'=>'No BPJS']])->label(false) ?></div>
				<div class='col-xs-4'><?= $form->field($model, 'nama_pasien', ['inputOptions' => ['class' => 'form-control','placeholder'=>'Nama Pasien']])->label(false) ?></div>
			</div>
			
			
		</div>
	</div>
    
    



    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-danger']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
