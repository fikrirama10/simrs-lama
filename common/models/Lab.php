<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lab".
 *
 * @property int $id
 * @property int $idpengirim
 * @property int $idjenisp
 * @property string $no_rekmed
 * @property string $hasil
 * @property string $idrawat
 * @property int $idpemeriksa
 * @property string $tanggal_req
 * @property string $tgl_peniksa
 * @property int $status
 */
class Lab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkatjenisp','idpemeriksa','idjenisp','status'], 'integer'],
            [['hasil','kodelab'], 'string'],
            [['tanggal_req', 'tgl_peniksa'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idjenisp' => 'Idjenisp',
            'hasil' => 'Hasil',
            'tanggal_req' => 'Tanggal Req',
            'tgl_peniksa' => 'Tgl Peniksa',
            'status' => 'Status',
        ];
    }
    public function getDlab()
    {
        return $this->hasOne(Daflab::className(), ['id' => 'idjenisp']);
    }
		public function getOrlab()
    {
        return $this->hasOne(Orderlab::className(), ['kodelab' => 'kodelab']);
    }
    public function getKatlab()
    {
        return $this->hasOne(Kattindakanlab::className(), ['id' => 'idkatjenisp']);
    }
	public function getKat()
    {
        return $this->hasOne(Subkattindakanlab::className(), ['id' => 'idkatindakan']);
    }
     
}
