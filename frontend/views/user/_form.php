<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Privilages;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
	<?php $form = ActiveForm::begin(); ?>

	<div class='container-fluid' style='background:#fff; padding:20px 0px 20px 20px;'>
		<div class='col-md-8'>
		<div class='row'>
			<div class='col-md-12'> <?= $form->field($petugas, 'nama_petugas')->textInput(['maxlength' => true]) ?></div>
			<div class='col-md-9'> <?= $form->field($petugas, 'nohp')->textInput(['maxlength' => true]) ?></div>
			<div class='col-md-3'><?= $form->field($petugas, 'jk')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => 'Jenis Kelamin'])->label("Jenis Kelamin") ?></div>
			<div class='col-md-12'> <?= $form->field($petugas, 'alamat')->textarea(['row' => 6]) ?></div>
			<div class='col-md-12'> <?= $form->field($model, 'idpriv')->dropDownList(ArrayHelper::map(Privilages::find()->all(), 'idpriv', 'privilages'))->label("Hak Akses")?></div>
			
			
		</div>
		</div>
		<div class='col-md-4'>
			<div class='col-md-12'><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
			<div class='col-md-12'><?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?></div>
			<?php $model->password = ($model->password)? $model->password_repeat : "" ?>
			<div class='col-md-12'><?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?></div>
			<div class='col-md-12'> <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?></div>
			<div class='col-md-12'>
			<div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
			</div>
		</div>
		
	</div>
	


	
   
    
   

    <?php ActiveForm::end(); ?>

</div>
