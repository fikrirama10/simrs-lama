<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Gagalfoto */

$this->title = 'Create Gagalfoto';
$this->params['breadcrumbs'][] = ['label' => 'Gagalfotos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gagalfoto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
