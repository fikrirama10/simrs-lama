<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_rajal".
 *
 * @property int $id
 * @property int $idrawat
 * @property int $idpoli
 * @property int $iddokter
 * @property string $suhu
 * @property string $respirasi
 * @property string $nadi
 * @property string $td
 * @property string $diagnosa
 * @property string $tanggal
 * @property string $tindakan
 * @property string $obat
 * @property string $tindakandokter
 * @property string $resepobat
 * @property string $lab
 * @property string $radiologi
 * @property string $pemeriksaan
 * @property int $status
 */
class PemeriksaanRajal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_rajal';
    }
    public function Pecah($id){
	$data = json_decode($id);
		if($data > 0){
		return implode(" , ",$data); 
		}else{
			return '';
		}
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'idpoli', 'iddokter', 'status','katpenyakitmulut','katgigi','macampenyakitmulut'], 'integer'],
            [['diagnosa',  'tindakandokter', 'resepobat',  'pemeriksaan','statuspasien'], 'string'],
            [['lab', 'radiologi','tindakan', 'obat','tanggal'], 'safe'],
			[['diagnosa','statuspasien'], 'required'],
            [['suhu', 'respirasi', 'nadi', 'td'], 'string', 'max' => 150],
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
            'idpoli' => 'Idpoli',
            'iddokter' => 'Iddokter',
            'suhu' => 'Suhu',
            'respirasi' => 'Respirasi',
            'nadi' => 'Nadi',
            'td' => 'Td',
            'diagnosa' => 'Diagnosa',
            'tanggal' => 'Tanggal',
            'tindakan' => 'Tindakan',
            'obat' => 'Obat',
            'tindakandokter' => 'Tindakandokter',
            'resepobat' => 'Resepobat',
            'lab' => 'Lab',
            'radiologi' => 'Radiologi',
            'pemeriksaan' => 'Pemeriksaan',
            'status' => 'Status',
        ];
    }
}
