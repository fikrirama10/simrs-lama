<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "obat".
 *
 * @property int $id
 * @property string $noobat
 * @property string $namaobat
 * @property string $kadaluarsa
 * @property int $stokgudang
 * @property int $idsuplier
 * @property string $harga
 * @property int $idsatuan
 * @property int $idjenisobat
 * @property int $stok
 * @property int $idkat
 * @property int $verived
 * @property string $hargabeli
 * @property string $idjenis
 */
class Obat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['idsatuan','namaobat','idkat'],'required'],
            [['kadaluarsa','sisaed'], 'safe'],
            [['stokgudang',  'idsatuan', 'idjenisobat', 'stok', 'idkat', 'verived' ,'ket','mstok','sisastok','sisa'], 'integer'],
            [['harga', 'hargabeli', 'idjenis'], 'number'],
            [['noobat', 'namaobat','khasiat','noreg'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'noobat' => 'Noobat',
            'namaobat' => 'Namaobat',
            'kadaluarsa' => 'Kadaluarsa',
            'stokgudang' => 'Stokgudang',
            'harga' => 'Harga',
            'idsatuan' => 'Idsatuan',
            'idjenisobat' => 'Idjenisobat',
            'stok' => 'Stok',
            'idkat' => 'Idkat',
            'verived' => 'Verived',
            'hargabeli' => 'Hargabeli',
            'idjenis' => 'Idjenis',
        ];
    }
	public function getSatuan()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'idsatuan']);
    }
	public function getKatego()
    {
        return $this->hasOne(Katbobat::className(), ['id' => 'idkat']);
    }
	 public function getJenis()
    {
        return $this->hasOne(Jenisbayar::className(), ['id' => 'idjenisobat']);
    }
	 public function getJeniso()
    {
        return $this->hasOne(Katjenis::className(), ['id' => 'idjenis']);
    }
    public static function getOptions($id){
		$data=  static::find()->where(['idjenisobat'=>$id])->andWhere(['<>','stok','0'])->all();
		$value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'namaobat','namaobat'); //id = your ID model, name = your caption

		return $value;
	}
}
