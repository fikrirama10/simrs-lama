<?php
use yii\helpers\Html;
?>

<header class="main-header">

    <?= Html::a('<b><span class="logo-lg">sima<span class="text-danger">MED</span> </span></b>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu" >

            <ul class="nav navbar-nav">


                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if(Yii::$app->user->identity->pegawai->avatar == null){ ?>
			<?php if(Yii::$app->user->identity->pegawai->jk == "L"){ ?>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/tes.png', ['alt'=>'no picture', 'class'=>'user-image'])?>
			
			<?php }else{ ?>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/tees2.png', ['alt'=>'no picture', 'class'=>'user-image'])?>
			<?php } ?>
			
			<?php }else{?>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.Yii::$app->user->identity->pegawai->avatar, ['alt'=>'no picture', 'class'=>'user-image'])?>
			<?php } ?>
		
                        <span class="hidden-xs"><?php echo Yii::$app->user->identity->pegawai->nama_petugas ; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                             <?php if(Yii::$app->user->identity->pegawai->avatar == null){ ?>
			<?php if(Yii::$app->user->identity->pegawai->jk == "L"){ ?>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/tes.png', ['alt'=>'no picture', 'class'=>'user-img img-circle'])?>
			
			<?php }else{ ?>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/tees2.png', ['alt'=>'no picture', 'class'=>'user-img img-circle'])?>
			<?php } ?>
			
			<?php }else{?>
			<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/user/'.Yii::$app->user->identity->pegawai->avatar, ['alt'=>'no picture', 'class'=>'user-img img-circle'])?>
			<?php } ?>

                            <p>
								<?php echo Yii::$app->user->identity->pegawai->nama_petugas ;?>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Ganti Password',
                                    ['/user/gantipass'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Logout',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
