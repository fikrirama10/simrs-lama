<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rawatjalan".
 *
 * @property int $id
 * @property string $idrawat
 * @property int $idverifed
 * @property string $antrian
 * @property string $no_rekmed
 * @property int $iddokter
 * @property int $idpoli
 * @property int $idbayar
 * @property string $tgldaftar
 * @property string $tglkeluar
 * @property string $penanggung
 * @property string $alamat_penanggung
 * @property int $hubungan
 * @property string $notlp
 * @property int $idkelas
 * @property int $idjenisrawat
 * @property int $idruangan
 * @property int $status
 * @property string $kdiagnosa
 * @property string $ketdiag
 * @property string $caradatang
 * @property string $rujukan
 * @property string $jampemeriksaan
 *
 * @property Jenisrawat $jenisrawat
 * @property Pasien $noRekmed
 * @property Pasien $noRekmed0
 */
class Rawatjalan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rawatjalan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idverifed', 'iddokter', 'idpoli', 'idbayar', 'hubungan', 'idkelas', 'idjenisrawat', 'idruangan', 'status'], 'integer'],
            [['tgldaftar', 'tglkeluar', 'jampemeriksaan'], 'safe'],
            [['alamat_penanggung', 'caradatang'], 'string'],
            [['idrawat', 'antrian', 'no_rekmed', 'penanggung', 'notlp', 'kdiagnosa', 'ketdiag', 'rujukan'], 'string', 'max' => 50],
            [['idjenisrawat'], 'exist', 'skipOnError' => true, 'targetClass' => Jenisrawat::className(), 'targetAttribute' => ['idjenisrawat' => 'id']],
            [['no_rekmed'], 'exist', 'skipOnError' => true, 'targetClass' => Pasien::className(), 'targetAttribute' => ['no_rekmed' => 'no_rekmed']],
            [['no_rekmed'], 'exist', 'skipOnError' => true, 'targetClass' => Pasien::className(), 'targetAttribute' => ['no_rekmed' => 'no_rekmed']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrawat' => 'Idrawat',
            'idverifed' => 'Idverifed',
            'antrian' => 'Antrian',
            'no_rekmed' => 'No Rekmed',
            'iddokter' => 'Iddokter',
            'idpoli' => 'Idpoli',
            'idbayar' => 'Idbayar',
            'tgldaftar' => 'Tgldaftar',
            'tglkeluar' => 'Tglkeluar',
            'penanggung' => 'Penanggung',
            'alamat_penanggung' => 'Alamat Penanggung',
            'hubungan' => 'Hubungan',
            'notlp' => 'Notlp',
            'idkelas' => 'Idkelas',
            'idjenisrawat' => 'Idjenisrawat',
            'idruangan' => 'Idruangan',
            'status' => 'Status',
            'kdiagnosa' => 'Kdiagnosa',
            'ketdiag' => 'Ketdiag',
            'caradatang' => 'Caradatang',
            'rujukan' => 'Rujukan',
            'jampemeriksaan' => 'Jampemeriksaan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisrawat()
    {
        return $this->hasOne(Jenisrawat::className(), ['id' => 'idjenisrawat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoRekmed()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoRekmed0()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
}
