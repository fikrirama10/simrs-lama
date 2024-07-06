<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Indikatorigd */

$this->title = 'Create Indikatorigd';
$this->params['breadcrumbs'][] = ['label' => 'Indikatorigds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indikatorigd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
