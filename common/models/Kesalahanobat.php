<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kesalahanobat".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $rm
 * @property int $jumlahjenis
 * @property int $bentuksediaan
 * @property int $dosis
 * @property int $aturan
 * @property int $komposisi
 * @property string $kesalahan
 */
class Kesalahanobat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kesalahanobat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['jumlahjenis', 'bentuksediaan', 'dosis', 'aturan', 'komposisi'], 'integer'],
            [['rm', 'kesalahan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'rm' => 'Rm',
            'jumlahjenis' => 'Jumlahjenis',
            'bentuksediaan' => 'Bentuksediaan',
            'dosis' => 'Dosis',
            'aturan' => 'Aturan',
            'komposisi' => 'Komposisi',
            'kesalahan' => 'Kesalahan',
        ];
    }
}
