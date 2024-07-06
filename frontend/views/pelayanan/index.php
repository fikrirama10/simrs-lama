<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Poli;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DaftaronlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$daftaronline = Poli::find()->all();
$this->title = 'Pelayanan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftaronline-index" style='margin-top:20px;'>
<section  class="medilife-blog-area section-padding-100">
        <div class="container"style='margin-top:100px;'>
		<h2 align=LEFT>PELAYANAN RAWAT JALAN RSAU LANUD SULAIMAN</h2><hr><br><br>
			
			<div class='row all-icons-area'>
					<?php foreach($daftaronline as $df):?>
					
					<div  class=" col-md-4 ">
					<a href='<?= Url::to(['/pelayanan/poli/'.$df->id])?>'>
                    <div class="medilife-single-icon">
                        <i class="<?= $df->icon?>"></i>
                        <h3><span><?= $df->namapoli?><h3><span></span></h3></span></h3>
                    </div>
					</a>
                </div>
					<?php endforeach ; ?>
			</div>
		</div>
</section>
</div>
