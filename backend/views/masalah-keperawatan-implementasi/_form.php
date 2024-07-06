<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use kartik\time\TimePicker;
use common\models\RencanaasuhanImplementasi;
use common\models\MasalahKeperawatanRencanaasuhan;
/* @var $this yii\web\View */
/* @var $model common\models\MasalahKeperawatanImplementasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="masalah-keperawatan-implementasi-form">

    <?php $form = ActiveForm::begin(); ?>


     <?= $form->field($model, 'idimplementasi')->dropDownList(ArrayHelper::map(RencanaasuhanImplementasi::find()->all(), 'id', 'implementasi'),['prompt'=>'- Pilih implementasi -'])->label('Jenis Implementasi')?>
	<div id='tni2'>
    <?= $form->field($model, 'implementasi')->textarea(['rows' => 3]) ?>
	</div>
	<div id='tni'>
    <?= $form->field($model, 'idintervensi')->dropDownList(ArrayHelper::map(MasalahKeperawatanRencanaasuhan::find()->where(['idrawat'=>$rawat->id])->all(), 'idrencana', 'rencana.rencanaasuhan'),['prompt'=>'- Pilih Intervensi Keperawatan -'])->label('Intervensi Keperawatan ')?>
	</div>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
	<?= $form->field($model, 'jam')->widget(TimePicker::classname(), ['pluginOptions' => [
						'showSeconds' => false,
						'showMeridian' => false,
						'minuteStep' => 1,
						'secondStep' => 5,
					]])->label('Jam'); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
$urlShowAll = Url::to(['pasien/show-all']);
$this->registerJs("
	
	

				$('#tni').addClass('disabel');
				// $('#tni2').addClass('disabel');
				
		
				$('#masalahkeperawatanimplementasi-idimplementasi').on('change',function() {
				
                var dob = $('#masalahkeperawatanimplementasi-idimplementasi').val();
				$('#coba').val(dob);
				if(dob == 31){
				$('#tni').removeClass('disabel');
				$('#tni2').addClass('disabel');
				
				}else{
				$('#tni').addClass('disabel');
				$('#tni2').removeClass('disabel');
				}
				});
        
	

", View::POS_READY);
?>
