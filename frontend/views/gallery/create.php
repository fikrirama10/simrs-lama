<?php
use yii\helpers\Html;

$this->title = 'Upload Image';
$this->params['breadcrumbs'][] = ['label' => 'Galeries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galery-create">
    <?= $this->render('_form', ['model' => $model,]) ?>
</div>
