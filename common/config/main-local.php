<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=u5053707_simrs',
            'username' => 'u5053707_simrslanud',
            'password' => 'Lanud@simrs2020',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'mail.sipppid.net',
				'username' => 'system',
				'password' => 'ppid2016',
				'port' => '587',
				'encryption' => 'tls',
				],
        ],
    ],
];
