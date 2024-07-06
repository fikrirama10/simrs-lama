<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Paket;
use common\models\PRoduk;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
	<meta name="google-site-verification" content="rHYcmThFE1fFnf13OtvvaRHNnSyv8QMvO_Ydk01T-_k" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>



<?php $this->beginBody() ?>


		

    <section>
        <?= $content ?>
    </section>

<?= $this->render('/site/bottom');?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
