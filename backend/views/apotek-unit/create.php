<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ApotekUnit */

$this->title = 'Order Apotek Unit';
$this->params['breadcrumbs'][] = ['label' => 'Apotek Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apotek-unit-create">
<div class="box box-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
