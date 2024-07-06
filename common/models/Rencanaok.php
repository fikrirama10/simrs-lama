<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rencanaok".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property string $tanggalperiksa
 * @property string $jadwaloprasi
 * @property string $diagnosa
 * @property int $status
 * @property int $iddokrer
 * @property string $idrawat
 */
class Rencanaok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rencanaok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggalperiksa', 'jadwaloprasi','catatan','tanggapan'], 'safe'],
            [['status', 'iddokrer'], 'integer'],
            [['no_rekmed', 'idrawat'], 'string', 'max' => 50],
            [['diagnosa'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rekmed' => 'No Rekmed',
            'tanggalperiksa' => 'Tanggalperiksa',
            'jadwaloprasi' => 'Jadwaloprasi',
            'diagnosa' => 'Diagnosa',
            'status' => 'Status',
            'iddokrer' => 'Iddokrer',
            'idrawat' => 'Idrawat',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
	public function getDokter()
    {
        return $this->hasOne(Dokter::className(), ['id' => 'iddokrer']);
    }
	public function getStat()
    {
        return $this->hasOne(Statusok::className(), ['id' => 'status']);
    }
}
