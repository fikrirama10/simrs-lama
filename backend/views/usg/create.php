<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Usg */

$this->title = 'Create Usg';
$this->params['breadcrumbs'][] = ['label' => 'Usgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
      
    ]) ?>

</div>
