<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Rawatjalan */

$this->title = 'Create Rawatjalan';
$this->params['breadcrumbs'][] = ['label' => 'Rawatjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rawatjalan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
