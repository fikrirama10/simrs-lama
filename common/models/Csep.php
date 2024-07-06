<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "csep".
 *
 * @property int $id
 * @property string $noKartu
 * @property string $tglSEP
 * @property string $ppkPelayanan
 * @property string $jnsPelayanan
 * @property string $noMR
 * @property string $dignosa
 * @property string $noTlp
 * @property string $catatan
 * @property string $noSEP
 * @property string $kdiag
 * @property string $kelas
 * @property string $dpjp
 * @property string $norujukan
 * @property string $faskes
 * @property string $tglRujukan
 * @property string $noSpri
 * @property string $spesialis
 */
class Csep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'csep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tglSEP', 'tglRujukan'], 'safe'],
            [['jnsPelayanan', 'dignosa'], 'string'],
            [['noKartu', 'ppkPelayanan', 'noMR', 'noTlp', 'catatan', 'noSEP', 'kdiag', 'kelas', 'dpjp', 'norujukan', 'faskes', 'noSpri', 'spesialis'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'noKartu' => 'No Kartu',
            'tglSEP' => false,
            'ppkPelayanan' => 'Ppk Pelayanan',
            'jnsPelayanan' => 'Jns Pelayanan',
            'noMR' => 'No Mr',
            'dignosa' => 'Dignosa',
            'noTlp' => 'No Tlp',
            'catatan' => 'Catatan',
            'noSEP' => 'No Sep',
            'kdiag' => 'Kdiag',
            'kelas' => 'Kelas',
            'dpjp' => 'Dpjp',
            'norujukan' => 'Norujukan',
            'faskes' => 'Faskes',
            'tglRujukan' => 'Tgl Rujukan',
            'noSpri' => 'No Spri',
            'spesialis' => 'Spesialis',
        ];
    }
}
