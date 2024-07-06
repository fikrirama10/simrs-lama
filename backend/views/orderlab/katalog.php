<?php
 use common\models\Kattindakanlab;
 use common\models\Subkattindakanlab;
 
 $katlab = Kattindakanlab::find()->all();
?>
<?php foreach($katlab as $kl): ?>

	<b><?= $kl->nama ?></b><br>
	<?php $sublab = Subkattindakanlab::find()->where(['idkat'=>$kl->id])->all() ?>
	
	<?php foreach($sublab as $sl): ?>
		 <?= $sl->nama ?>,
	<?php endforeach; ?><br>
<?php endforeach; ?>