<?php 
	use common\models\Jenispenerimaan;
	use common\models\JenispenerimaanDetail;
	use common\models\Trandetail;
	use common\models\Jenisbayar;
	use yii\helpers\Url;
	use kartik\date\DatePicker;
	use yii\widgets\Pjax;
	use yii\web\View;
	$bayar = Jenisbayar::find()->where(['between','id',4,5])->all();
	$penerimaan = Jenispenerimaan::find()->all();
	$no = 1;
?>		
		<table class='table'>	
			<?php $total_all = Trandetail::find()->joinWith(['transaksi as tx'])->where(['tx.idbayar'=>$search])->andwhere(['MONTH(tx.tglbayar)'=>$start])->andwhere(['YEAR(tx.tglbayar)'=>$end])->sum('trandetail.total');?>
					<tr class='bg-primary'>
						<th scope="col">Akun & Kategori</th>
						<th align='right'><?= $start ?> / <?= $end ?></th>
					</tr>
					<tr class='bg-orange'>
						<th scope="col">Total</th>
						<th align='right'>Rp. <?= Yii::$app->algo->IndoCurr($total_all)?></th>
					</tr>
					
					<?php foreach($penerimaan as $pn): 
						$detail = JenispenerimaanDetail::find()->where(['idpenerimaan'=>$pn->id])->all();
					?>
					<?php $ddrt = Trandetail::find()->joinWith(['tindakan as t'])->joinWith(['tindakan.terima as tt'])->joinWith(['transaksi as tx'])->where(['tt.idpenerimaan'=>$pn->id])->andwhere(['tx.idbayar'=>$search])->andwhere(['MONTH(tx.tglbayar)'=>$start])->andwhere(['YEAR(tx.tglbayar)'=>$end])->sum('trandetail.total');  ?>
						<tr class='bg-gray'>
							<th><?= $pn->jenispenerimaan?></th>
							<th>Rp. <?= Yii::$app->algo->IndoCurr($ddrt)?></th>
						</tr>
						<?php foreach($detail as $d){  ?>
						<?php $trxtc = Trandetail::find()->joinWith(['tindakan as t'])->joinWith(['transaksi as tx'])->where(['t.jenisterima'=>$d->id])->andwhere(['tx.idbayar'=>$search])->andwhere(['MONTH(tx.tglbayar)'=>$start])->andwhere(['YEAR(tx.tglbayar)'=>$end])->sum('trandetail.total');  ?>
						<tr>
							<td  style='text-indent: 20px;'><a><?= $d->namapenerimaan?></a></td>
							<td  style='text-indent: 20px;'>Rp. <?= Yii::$app->algo->IndoCurr($trxtc)?></td>
						</tr>
						<?php }?>
						
					<?php endforeach ; ?>
					
				
			</table>