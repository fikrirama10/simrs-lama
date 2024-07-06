<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/slider.css',
      
    ];
    public $js = [
	  'css/scrollreveal.js',
        'css/scrollreveal.min.js',
        'css/blur.js',
        'css/slider.js',
        'css/scrolling-nav.js',
        'css/huruf.js',
        'css/fa.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
