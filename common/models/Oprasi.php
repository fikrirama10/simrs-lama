<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oprasi".
 *
 * @property int $id
 * @property string $status
 * @property string $idoprasi
 * @property string $idrawat
 * @property string $no_rekmed
 * @property string $catatan
 * @property string $tanggal
 * @property string $jenisoprasi
 * @property int $juduloprasi
 * @property int $diagnosapasca
 * @property int $diagnosapra
 * @property int $dokterbedah1
 * @property int $dokterbedah2
 * @property int $perawat1
 * @property int $perawat2
 * @property string $jammulai
 * @property string $jamselesai
 */
class Oprasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oprasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catatan'], 'string'],
            [['tanggal', 'jammulai', 'jamselesai'], 'safe'],
            [[ 'dokterbedah1', 'dokterbedah2', 'perawat1', 'perawat2','status'], 'integer'],
            [['juduloprasi', 'diagnosapasca', 'diagnosapra', 'idoprasi', 'idrawat', 'no_rekmed', 'jenisoprasi'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'idoprasi' => 'Idoprasi',
            'idrawat' => 'Idrawat',
            'no_rekmed' => 'No Rekmed',
            'catatan' => 'Catatan',
            'tanggal' => 'Tanggal',
            'jenisoprasi' => 'Jenisoprasi',
            'juduloprasi' => 'Juduloprasi',
            'diagnosapasca' => 'Diagnosapasca',
            'diagnosapra' => 'Diagnosapra',
            'dokterbedah1' => 'Dokterbedah1',
            'dokterbedah2' => 'Dokterbedah2',
            'perawat1' => 'Perawat1',
            'perawat2' => 'Perawat2',
            'jammulai' => 'Jammulai',
            'jamselesai' => 'Jamselesai',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
}
