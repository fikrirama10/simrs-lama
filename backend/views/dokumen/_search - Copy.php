<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use common\models\DokumenJenis;
use common\models\DokumenKategori;
use common\models\Skpd;
?>

<div class="dokumen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	
	<div class='row'>
		<div class='col-sm-3'>
			<?= $form->field($model, 'IdJenis')->dropDownList(ArrayHelper::map(DokumenJenis::find()->all(), 'Id', 'Jenis'),['prompt'=>'- Semua Kategori -'])->label('Kategori')?>
		</div>
		<div class='col-sm-3'>
			<?= $form->field($model, 'IdKat')->dropDownList(ArrayHelper::map(DokumenKategori::find()->all(), 'Id', 'Kategori'),['prompt'=>'- Semua Jenis -'])->label('Jenis');?>
		</div>
		<?php if(Yii::$app->user->identity->member->IsAdmin == 1):?>
			<div class='col-sm-3'>
			<?= $form->field($model, 'IdSKPD')->dropDownList(ArrayHelper::map(Skpd::find()->where(['ParentKode' => Yii::$app->params['IdPPID']])->all(), 'Kode', 'Institusi'),['prompt'=>'- Semua Komponen -'])->label('Penerbit');?>
			</div>
		<?php endif;?>
		
		<div class='col-sm-2'>
			<label>&nbsp;</label><br/>
			<?= Html::submitButton('<i class="fa fa-search"></i> Cari', ['class' => 'btn btn-primary']) ?>
			<?= Html::a('Reset',['/dokumen/index'],['class' => 'btn btn-default']);?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
