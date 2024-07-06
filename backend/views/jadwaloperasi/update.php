<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jadwaloprasi */

$this->title = 'Update Jadwaloprasi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jadwaloprasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwaloprasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
