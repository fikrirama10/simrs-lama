<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apd".
 *
 * @property int $id
 * @property string $tgl
 * @property string $petugas
 * @property int $handscoon
 * @property int $masker
 * @property int $apron
 * @property int $patuh
 */
class Apd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'apd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal','tindakan'], 'safe'],
            [['handscoon', 'masker', 'apron', 'patuh'], 'integer'],
            [['petugas'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl' => 'Tgl',
            'petugas' => 'Petugas',
            'handscoon' => 'Handscoon',
            'masker' => 'Masker',
            'apron' => 'Apron',
            'patuh' => 'Patuh',
        ];
    }
}
