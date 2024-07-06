<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "personel".
 *
 * @property int $id
 * @property int $nik
 * @property int $nrp
 * @property string $foto
 * @property string $pangkat
 * @property string $nama
 * @property string $tgllahir
 * @property string $nohp
 * @property string $kepegawaian
 * @property string $profesi
 * @property string $alamat
 */
class Personel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nik', 'nrp'], 'string'], 
            [['tgllahir'], 'safe'],
            [['kepegawaian', 'profesi', 'alamat'], 'string'],
            [['foto', 'pangkat', 'nama', 'nohp'], 'string', 'max' => 50],
            [['nik'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nik' => 'Nik',
            'nrp' => 'Nrp',
            'foto' => 'Foto',
            'pangkat' => 'Pangkat',
            'nama' => 'Nama',
            'tgllahir' => 'Tgllahir',
            'nohp' => 'Nohp',
            'kepegawaian' => 'Kepegawaian',
            'profesi' => 'Profesi',
            'alamat' => 'Alamat',
        ];
    }
}
