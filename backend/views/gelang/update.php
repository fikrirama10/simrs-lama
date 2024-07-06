<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Gelang */

$this->title = 'Update Gelang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gelangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gelang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
