<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Ppi */

$this->title = 'Create Ppi';
$this->params['breadcrumbs'][] = ['label' => 'Ppis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
