<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_ranap".
 *
 * @property int $id
 * @property int $idrawat
 * @property string $tanggal
 * @property int $perawat
 * @property string $td
 * @property string $nadi
 * @property string $respirasi
 * @property string $suhu
 * @property string $keadaanumum
 * @property string $keadaanfisik
 * @property string $status
 * @property string $jam
 * @property string $tindakan
 * @property string $obat
 * @property string $lab
 * @property string $radiologi
 * @property string $detailtindakan
 * @property string $detailobat
 */
class PemeriksaanRanap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_ranap';
    }

    /**
     * {@inheritdoc}
     */
	public function Pecah($id){
	$data = json_decode($id);
	
		if($data > 0){
		return implode(" , ",$data); 
		}else{
			return '';
		}
	}
    public function rules()
    {
        return [
            [['idrawat', 'perawat'], 'integer'],
            [['tanggal', 'jam' , 'tindakan', 'obat', 'lab', 'radiologi'], 'safe'],
            [['keadaanumum', 'keadaanfisik', 'status', 'detailtindakan', 'detailobat'], 'string'],
            [['td', 'nadi', 'respirasi', 'suhu'], 'string', 'max' => 50],
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
            'tanggal' => 'Tanggal',
            'perawat' => 'Perawat',
            'td' => 'Td',
            'nadi' => 'Nadi',
            'respirasi' => 'Respirasi',
            'suhu' => 'Suhu',
            'keadaanumum' => 'Keadaanumum',
            'keadaanfisik' => 'Keadaanfisik',
            'status' => 'Status',
            'jam' => 'Jam',
            'tindakan' => 'Tindakan',
            'obat' => 'Obat',
            'lab' => 'Lab',
            'radiologi' => 'Radiologi',
            'detailtindakan' => 'Detailtindakan',
            'detailobat' => 'Detailobat',
        ];
    }
}
