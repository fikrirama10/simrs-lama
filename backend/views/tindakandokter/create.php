<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tindakandokter */

$this->title = 'Create Tindakandokter';
$this->params['breadcrumbs'][] = ['label' => 'Tindakandokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tindakandokter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
