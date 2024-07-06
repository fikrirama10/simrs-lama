<?php

use yii\helpers\Html;
use yii\grid\GridView;
$awal  = date_create('1988-08-10');
$akhir = date_create(); // waktu sekarang
$diff  = date_diff( $awal, $akhir );
/* @var $this yii\web\View */
/* @var $searchModel common\models\PoliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Polis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poli-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
	echo 'Selisih waktu: ';
echo $diff->y . ' tahun, ';
echo $diff->m . ' bulan, ';
echo $diff->d . ' hari, ';
echo $diff->h . ' jam, ';
echo $diff->i . ' menit, ';
echo $diff->s . ' detik, ';
	?>

    <p>
        <?= Html::a('Create Poli', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   
</div>
