<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PasisenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasisen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['igd2'],
        'method' => 'get',
    ]); ?>
	<div class='row'>
		<div class='col-md-6'>
			<div class='row'>
				<div class='col-xs-4'><?= $form->field($model, 'no_rekmed', ['inputOptions' => ['autofocus' => 'autofocus', 'class'=> 'form-control', 'tabindex' => '1']])->label('Nomor Rekamedis ') ?></div>
				
	
				
			</div>
			
			
		</div>
	</div>
    
    



    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
