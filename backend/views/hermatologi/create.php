<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Hermatologi */

$this->title = 'Create Hermatologi';
$this->params['breadcrumbs'][] = ['label' => 'Hermatologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hermatologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
