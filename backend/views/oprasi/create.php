<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Oprasi */

$this->title = 'Create Oprasi';
$this->params['breadcrumbs'][] = ['label' => 'Oprasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oprasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
