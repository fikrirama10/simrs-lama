<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $pasien common\models\Daftaronline */

?>
<div class="daftaronline-view">
<section  class="medilife-blog-area section-padding-100">
        <div class="container"style='margin-top:100px;'>
			 <?php $form = ActiveForm::begin(); ?>
			<h2>Create Pasien Baru</h2><hr>
			<div class='row'>
				<div class='col-md-6'>
					 <?= $form->field($pasien, 'nokartu')->textInput() ?>

    <?= $form->field($pasien, 'idbayar')->textInput() ?>

    <?= $form->field($pasien, 'noregistrasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($pasien, 'tanggal')->textInput() ?>

    <?= $form->field($pasien, 'idpoli')->textInput() ?>

    <?= $form->field($pasien, 'nama_pasien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($pasien, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($pasien, 'nohp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($pasien, 'tgl_lahir')->textInput() ?>

    <?= $form->field($pasien, 'usia')->textInput() ?>

    <?= $form->field($pasien, 'idprov')->textInput() ?>

    <?= $form->field($pasien, 'idkab')->textInput() ?>

    <?= $form->field($pasien, 'idkec')->textInput() ?>

    <?= $form->field($pasien, 'idkel')->textInput() ?>

    <?= $form->field($pasien, 'pendidikan')->textInput() ?>

    <?= $form->field($pasien, 'no_ktp')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

				</div>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
</section>
</div>
