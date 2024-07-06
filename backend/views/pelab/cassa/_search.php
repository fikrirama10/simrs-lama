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
		<div class='col-md-5'>
			<div class='row'>
				<div class="input-group" style='padding-top:20px; padding-left:10px;'> 
				<input id="transaksisearch-judul" class="form-control" placeholder="Cari No Rawat" name="RawatjalanSearch[idrawat]" autofocus type="text" >
				<span class="input-group-addon" id="basic-addon1"><i class='glyphicon glyphicon-search'></i></span>
				</div>
			</div>
			
			
		</div>
	</div>
    
    



    <div class="form-group">
       
    </div>

    <?php ActiveForm::end(); ?>

</div>
