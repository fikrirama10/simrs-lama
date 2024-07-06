<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Prlab */

$this->title = 'Create Prlab';
$this->params['breadcrumbs'][] = ['label' => 'Prlabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prlab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
