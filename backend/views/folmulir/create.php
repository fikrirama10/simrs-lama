<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Folmulir */

$this->title = 'Create Folmulir';
$this->params['breadcrumbs'][] = ['label' => 'Folmulirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folmulir-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
