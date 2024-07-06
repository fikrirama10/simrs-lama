<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Temusg */

$this->title = 'Create Temusg';
$this->params['breadcrumbs'][] = ['label' => 'Temusgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temusg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
