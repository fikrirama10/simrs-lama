<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Rekamedis */

$this->title = 'Create Rekamedis';
$this->params['breadcrumbs'][] = ['label' => 'Rekamedis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekamedis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
