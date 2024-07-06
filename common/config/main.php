<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
	
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'algo' => [
			'class' => 'common\components\AlgoFunction',
		],
		'kazo' => [
			'class' => 'common\components\FikriFunction',
		],
		'vclaim' => [
			'class' => 'common\components\VclaimFunction',
		],
		'reCaptcha' => [
			'name' => 'reCaptcha',
			'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
			'siteKey' => '6LcCISATAAAAAFCDI5jilKehKY7PxiVpclnp2sv6',
			'secret' => '6LcCISATAAAAAOM209GQvWwpmA-iS18pDc0Ok16u',
		],
	
		'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'sapa.kemendagri.go.id',
				'username' => 'info@sapa.kemendagri.go.id',
				'password' => 'indonesia2016',
				'port' => '587',
				'encryption' => 'tls',
				'streamOptions' => [
						'ssl' => [ 'allow_self_signed' => true, 'verify_peer' => false, 'verify_peer_name' => false, ], 
						],
			],
		],
    ],
	'modules' => [
		'datecontrol' =>  [
			'class' => '\kartik\datecontrol\Module'
			],
		'gridview' =>  [
			'class' => '\kartik\grid\Module'
			],
	],
];
