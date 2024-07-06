<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Orderlab */

$this->title = 'Create Orderlab';
$this->params['breadcrumbs'][] = ['label' => 'Orderlabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderlab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
