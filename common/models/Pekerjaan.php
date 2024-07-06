<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pekerjaan".
 *
 * @property integer $id
 * @property integer $idjenis
 * @property string $tempatkerja
 * @property string $alamat_kerja
 * @property string $notlp
 * @property string $pangkat
 * @property integer $nrp
 * @property string $kesatuan
 * @property string $idpasien
 */
class Pekerjaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pekerjaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idjenis', 'nrp'], 'integer'],
            [['tempatkerja', 'alamat_kerja', 'pangkat'], 'string'],
            [['notlp', 'kesatuan', 'idpasien'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idjenis' => 'Jenis Pekerjaan',
            'tempatkerja' => 'Tempatkerja',
            'alamat_kerja' => 'Alamat Kerja',
            'notlp' => 'Notlp',
            'pangkat' => 'Pangkat',
            'nrp' => 'Nrp',
            'kesatuan' => 'Kesatuan',
            'idpasien' => 'Idpasien',
        ];
    }
		 public function getKerja()
    {
        return $this->hasOne(Jenispekerjaan::className(), ['id' => 'idjenis']);
    }
}
