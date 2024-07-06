<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kuota_pasien".
 *
 * @property int $id
 * @property string $tgl
 * @property int $status
 * @property int $idhari
 * @property int $kuota
 * @property int $sisa
 * @property int $idpoli
 * @property int $iddokter
 */
class KuotaPasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kuota_pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl'], 'safe'],
            [['status', 'idhari', 'kuota', 'sisa', 'idpoli', 'iddokter'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl' => 'Tgl',
            'status' => 'Status',
            'idhari' => 'Idhari',
            'kuota' => 'Kuota',
            'sisa' => 'Sisa',
            'idpoli' => 'Idpoli',
            'iddokter' => 'Iddokter',
        ];
    }
	public function getPoli()
    {
        return $this->hasOne(Poli::className(), ['id' => 'idpoli']);
    }
	public function getDokter()
    {
        return $this->hasOne(Dokter::className(), ['id' => 'iddokter']);
    }
}
