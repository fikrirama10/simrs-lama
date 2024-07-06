<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cuciinap */

$this->title = 'Create Cuciinap';
$this->params['breadcrumbs'][] = ['label' => 'Cuciinaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuciinap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
