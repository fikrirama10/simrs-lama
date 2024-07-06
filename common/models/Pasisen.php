<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pasisen".
 *
 * @property integer $id
 * @property string $no_rekmed
 * @property integer $no_identitas
 * @property string $tempat_lahir
 * @property string $nama_pasien
 * @property string $nama_panggilan
 * @property string $jenis_kelamin
 * @property string $gol_darah
 * @property string $nama_ibu
 * @property string $nohp
 * @property string $alamat
 * @property integer $kodepos
 * @property integer $id_status
 * @property string $tanggal_lahir
 * @property string $created_at
 * @property integer $idverifed
 *
 * @property Statushub $idStatus
 */
class Pasisen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $Cnt;
    public static function tableName()
    {
        return 'pasisen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_rekmed', 'nama_pasien', 'nama_ibu','id_status'], 'required'],
            [['no_identitas', 'kodepos', 'id_status', 'idverifed'], 'integer'],
            [['jenis_kelamin', 'gol_darah', 'alamat'], 'string'],
            [['tanggal_lahir', 'created_at'], 'safe'],
            [['no_rekmed'], 'string', 'max' => 50],
            [['tempat_lahir', 'nama_pasien', 'nama_panggilan', 'nama_ibu', 'nohp'], 'string', 'max' => 255],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => Statushub::className(), 'targetAttribute' => ['id_status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rekmed' => 'No Rekmed',
            'no_identitas' => 'No Identitas',
            'tempat_lahir' => 'Tempat Lahir',
            'nama_pasien' => 'Nama Pasien',
            'nama_panggilan' => 'Nama Panggilan',
            'jenis_kelamin' => 'Jenis Kelamin',
            'gol_darah' => 'Gol Darah',
            'nama_ibu' => 'Nama Ibu',
            'nohp' => 'Nohp',
            'alamat' => 'Alamat',
            'kodepos' => 'Kodepos',
            'id_status' => 'Id Status',
            'tanggal_lahir' => 'Tanggal Lahir',
            'created_at' => 'Created At',
            'idverifed' => 'Idverifed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatus()
    {
        return $this->hasOne(Statushub::className(), ['id' => 'id_status']);
    }
	 public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['id_prov' => 'nama']);
    }
}
