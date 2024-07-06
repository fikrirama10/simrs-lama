<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<td class="col-lg-1">
   <?= ($model->iddetail)?$model->penerimaan:$model->penerimaan ?>
</td>
<td class="col-lg-2">
    <?= Html::activeTextInput($model, "[$key]nilaipagu", ['data-field' => 'price','size' => 16, 'id' => false, 'class' => 'form-control ',]) ?>
</td>
<td class="col-lg-2">
    %
</td>
