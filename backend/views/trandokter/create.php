<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Trandokter */

$this->title = 'Create Trandokter';
$this->params['breadcrumbs'][] = ['label' => 'Trandokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trandokter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
