<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Apotekumum */

$this->title = 'Create Apotekumum';
$this->params['breadcrumbs'][] = ['label' => 'Apotekumums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apotekumum-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
