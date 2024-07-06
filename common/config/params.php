<?php
return [
    'adminEmail' => 'developer@sip-ppid.net',
    'supportEmail' => 'support@sip-ppid.net',
    'user.PasswordResetTokenExpire' => 3600,
	
	/* sesuaikan dengan alamat real */
	'baseUrl' => 'https://simrs.rsausulaiman.com',
	'baseUrl2' => 'https://simrs.rsausulaiman.com/',
	'x-token' => '1eiW0Ycndlhm0boaHXlJeDPV573-Mdg8',
	/* sesuaikan dengan kode PPID masing-masing daerah */
	
	/* parameter default jangan diubah */
	'imagePath' => Yii::getAlias('@frontend').'/images',
	'imageNewsPath' => Yii::getAlias('@frontend').'/images/articles',
	'resourcesPath' => Yii::getAlias('@frontend').'/images/resources',
	'uploadPath' => Yii::getAlias('@frontend').'/uploads',
	'documentPath' => Yii::getAlias('@frontend').'/upload/documents',
];
