<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<td class="col-lg-1">
   <?= ($model->idobat)?$model->namaobat:$model->namaobat ?>
</td>
<td class="col-lg-2">
    <?= Html::activeTextInput($model, "[$key]qty", ['data-field' => 'price','size' => 16, 'id' => false, 'class' => 'form-control ',]) ?>
</td>
<td class="col-lg-1">
   <?= ($model->idsatuan)?$model->idsatuan:$model->idsatuan ?>
</td>
<td class="col-lg-1">
   <?= ($model->sisastok)?$model->sisastok:$model->sisastok ?>
</td>
