<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
?>
<td class="col-lg-1">
   <?= ($model->idbarang)?$model->namaobat:$model->namaobat ?>
</td>
<td class="col-lg-1">
   <?= ($model->permintaan)?$model->permintaan:$model->permintaan ?>
</td>
<td class="col-lg-1">
    <?= Html::activeTextInput($model, "[$key]qty", ['data-field' => 'price','size' => 16, 'id' => false, 'class' => 'form-control ',]) ?>
</td>
<td class="col-lg-5">
<?=	DatePicker::widget([
    'model' => $model, 
    'attribute' =>"[$key]ed",
    'options' => ['placeholder' => 'ED'],
    'pluginOptions' => [
        'autoclose'=>true,
		'format' => 'yyyy-mm-dd'
    ]
]); ?>
</td>
