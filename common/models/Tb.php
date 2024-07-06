<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tb".
 *
 * @property int $id
 * @property string $no_rm
 * @property string $nama
 * @property int $usia
 * @property string $tgl_lahir
 * @property string $berat_badan
 * @property string $tinggi_badan
 * @property string $ktp
 * @property string $bpjs
 * @property string $no_hp
 * @property string $jenis_pasien
 * @property string $jenis_kelamin
 * @property string $alamat
 */
class Tb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usia'], 'integer'],
            [['tgl_lahir'], 'safe'],
            [['jenis_pasien'], 'string'],
            [['no_rm', 'nama', 'berat_badan', 'tinggi_badan', 'ktp', 'bpjs', 'no_hp', 'jenis_kelamin'], 'string', 'max' => 50],
            [['alamat'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rm' => 'No Rm',
            'nama' => 'Nama',
            'usia' => 'Usia',
            'tgl_lahir' => 'Tgl Lahir',
            'berat_badan' => 'Berat Badan',
            'tinggi_badan' => 'Tinggi Badan',
            'ktp' => 'Ktp',
            'bpjs' => 'Bpjs',
            'no_hp' => 'No Hp',
            'jenis_pasien' => 'Jenis Pasien',
            'jenis_kelamin' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
        ];
    }
}
