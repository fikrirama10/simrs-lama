<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<td class="col-lg-1">
   <?= ($model->kat)?$model->nama:$model->nama ?>
</td>
<td class="col-lg-2">
    <?= Html::activeTextInput($model, "[$key]hasil", ['data-field' => 'price','size' => 16, 'id' => false, 'class' => 'form-control ',]) ?>
</td>
<td class="col-lg-1">
   <?= ($model->satuan)?$model->satuan:$model->satuan ?>
</td>
<td class="col-lg-1">
   <?= ($model->rujukan)?$model->rujukan:$model->rujukan ?>
</td>