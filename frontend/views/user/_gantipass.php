<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\UserPriviledges;
use common\models\Provinsi;
use common\models\Card;
use common\models\Cabang;
use common\models\Jabatan;
use kartik\file\FileInput;
use kartik\datecontrol\DateControl;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form  */
?>

<div class="user-form">
	  <?php $form = ActiveForm::begin(); ?>
	<div class='row'>
		<div class='col-sm-12'>
			<div class="form-group field-current-password required">
				<label class="control-label" for="current-password">Password Lama</label>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-lock"></i>
					</span>
					<input type="text" id="current-password" name="current-password" class="form-control">
				</div>
			</div>
			<input type="hidden" id="old-password" name="old-password" value="<?= $model->password_repeat ?>">
			<?php $model->password = ($model->password)? "" : "" ?>
			<?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Password Baru') ?>
			<?php $model->password_repeat = ($model->password_repeat)? "" : "" ?>
			<?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true])->label('Ulangi Password') ?>
		</div>
		<div class='col-sm-12'>
			<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Ganti', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		</div>
		
		<?php ActiveForm::end(); ?>
	</div>
</div>
<?php
use yii\web\View;
$this->registerJs("
    // $('#ganti-password').on('submit', function() {
		// old = $('#old-password').val();
		// current = $('#current-password').val();
		// if()
		// alert('test');
	// });
", View::POS_READY);
?>
