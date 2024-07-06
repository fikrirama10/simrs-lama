<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Oprasi */

$this->title = 'Update Oprasi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Oprasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="oprasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
