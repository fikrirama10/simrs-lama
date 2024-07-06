<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RikkesRadiologi */

$this->title = 'Create Rikkes Radiologi';
$this->params['breadcrumbs'][] = ['label' => 'Rikkes Radiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rikkes-radiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
