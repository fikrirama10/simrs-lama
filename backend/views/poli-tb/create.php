<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tb */

$this->title = 'Create Tb';
$this->params['breadcrumbs'][] = ['label' => 'Tbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
