<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "keluhan".
 *
 * @property integer $id
 * @property string $kode_p
 * @property string $no_rekmed
 * @property string $keluhan
 * @property string $rwt_penyakits
 * @property string $rwt_penyakitd
 * @property string $rwt_penyakitk
 * @property string $alergi
 * @property string $tanggal
 * @property integer $idpemeriksa
 */
class Keluhan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keluhan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_rekmed'], 'required'],
            [['keluhan', 'rwt_penyakits', 'rwt_penyakitd', 'rwt_penyakitk'], 'string'],
            [['tanggal'], 'safe'],
            [['idpemeriksa','idtkp'], 'integer'],
            [['kode_p', 'no_rekmed', 'alergi'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_p' => 'Kode P',
            'no_rekmed' => 'No Rekmed',
            'keluhan' => 'Keluhan',
            'rwt_penyakits' => 'Rwt Penyakits',
            'rwt_penyakitd' => 'Rwt Penyakitd',
            'rwt_penyakitk' => 'Rwt Penyakitk',
            'alergi' => 'Alergi',
            'tanggal' => 'Tanggal',
            'idpemeriksa' => 'Idpemeriksa',
        ];
    }
}
