<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Rencanaok */

$this->title = 'Create Rencanaok';
$this->params['breadcrumbs'][] = ['label' => 'Rencanaoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rencanaok-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
