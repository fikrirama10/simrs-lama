<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apdinap".
 *
 * @property int $id
 * @property string $tindakan
 * @property string $tanggal
 * @property string $petugas
 * @property int $handscoon
 * @property int $masker
 * @property int $apron
 * @property int $validator
 * @property int $patuh
 */
class Apdinap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'apdinap';
    }

    /**
     * {@inheritdoc}
     */
	 
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['handscoon', 'masker', 'apron', 'validator', 'patuh'], 'integer'],
            [['tindakan', 'petugas'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tindakan' => 'Tindakan',
            'tanggal' => 'Tanggal',
            'petugas' => 'Petugas',
            'handscoon' => 'Handscoon',
            'masker' => 'Masker',
            'apron' => 'Apron',
            'validator' => 'Validator',
            'patuh' => 'Patuh',
        ];
    }
}
