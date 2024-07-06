<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pemeriksaanawal_ranap".
 *
 * @property int $id
 * @property int $idrawat
 * @property string $anamnesa
 * @property string $kesadaran
 * @property string $fisik
 * @property string $suhu
 * @property string $td
 * @property string $respirasi
 * @property string $nadi
 * @property string $diagnosa_awal
 * @property string $diagnosa_akhir
 * @property string $jam_masuk
 */
class PemeriksaanawalRanap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaanawal_ranap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat'], 'integer'],
            [['anamnesa', 'kesadaran', 'fisik'], 'string'],
            [['jam_masuk'], 'safe'],
            [['suhu', 'td', 'respirasi', 'nadi'], 'string', 'max' => 50],
            [['diagnosa_awal', 'diagnosa_akhir'], 'string', 'max' => 150],
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
            'anamnesa' => 'Anamnesa',
            'kesadaran' => 'Kesadaran',
            'fisik' => 'Fisik',
            'suhu' => 'Suhu',
            'td' => 'Td',
            'respirasi' => 'Respirasi',
            'nadi' => 'Nadi',
            'diagnosa_awal' => 'Diagnosa Awal',
            'diagnosa_akhir' => 'Diagnosa Akhir',
            'jam_masuk' => 'Jam Masuk',
        ];
    }
}
