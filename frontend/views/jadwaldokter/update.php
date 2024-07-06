<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jadwaldokter */

$this->title = 'Update Jadwaldokter: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jadwaldokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwaldokter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
