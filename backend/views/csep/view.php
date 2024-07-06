<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model common\models\Csep */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cseps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
						<?=	$form->field($model, 'tglSEP')->widget(DatePicker::classname(),[
						'type' => DatePicker::TYPE_COMPONENT_APPEND,
						'pluginOptions' => [
						'autoclose'=>true,
						'format' => 'yyyy-mm-dd',
						'todayHighlight' => true,
						 'autoclose'=>true,
						'startDate' => date('Y-m-d'),
						'endDate' => "0d"
						]
						])->label(false);?>
					 <?php ActiveForm::end(); ?>