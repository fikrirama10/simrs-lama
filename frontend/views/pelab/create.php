<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pelab */

$this->title = 'Create Pelab';
$this->params['breadcrumbs'][] = ['label' => 'Pelabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
