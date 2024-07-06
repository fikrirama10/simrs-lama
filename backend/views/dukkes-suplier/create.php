<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DukkesSuplier */

$this->title = 'Create Dukkes Suplier';
$this->params['breadcrumbs'][] = ['label' => 'Dukkes Supliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dukkes-suplier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
