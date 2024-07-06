<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Temusg */

$this->params['breadcrumbs'][] = ['label' => 'Temusgs', 'url' => ['index']];

?>
<div class="temusg-view">

    <h1><?= Html::encode($this->title) ?></h1>
	<div class='box box-body'>
		<h2><?= $model->judul ?></h2>
		<?= $model->hasil?><br>
		Kesimpulan :<br>
		<?= $model->kesimpulan?>
	</div>

</div>
