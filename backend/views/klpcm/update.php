<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Klpcm */

$this->title = 'Update Klpcm: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Klpcms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="klpcm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
