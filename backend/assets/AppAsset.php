<?php

namespace backend\assets;

use yii\web\AssetBundle;
//use faryshta\disableSubmitButtons\Asset as DisableSubmitButtonAsset;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
		//DisableSubmitButtonsAsset::class,
    ];
}
