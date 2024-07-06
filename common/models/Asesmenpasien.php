<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asesmenpasien".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property int $anamesisi
 * @property int $ass_psiko
 * @property int $rx_fisik
 * @property int $penunjang
 * @property int $diagnosis
 * @property int $rencanaasuhan
 * @property int $evaluasi
 * @property int $Column 10
 * @property int $ttd
 */
class Asesmenpasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'asesmenpasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anamesisi', 'ass_psiko', 'rx_fisik', 'penunjang', 'diagnosis', 'rencanaasuhan','lengkap', 'evaluasi', 'ttd','verifikator'], 'integer'],
			[['tanggal'], 'safe'],
            [['no_rekmed','sempel'], 'string', 'max' => 50],
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
            'anamesisi' => 'Anamesisi',
            'ass_psiko' => 'Ass Psiko',
            'rx_fisik' => 'Rx Fisik',
            'penunjang' => 'Penunjang',
            'diagnosis' => 'Diagnosis',
            'tanggal' => 'Tanggal',
            'sempel' => 'Sempel',
            'rencanaasuhan' => 'Rencanaasuhan',
            'evaluasi' => 'Evaluasi',
            'ttd' => 'Ttd',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
}
