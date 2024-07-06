<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Indirawat */

$this->title = 'Create Indirawat';
$this->params['breadcrumbs'][] = ['label' => 'Indirawats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indirawat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
