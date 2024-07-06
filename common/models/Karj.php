<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "karj".
 *
 * @property int $id
 * @property int $verived
 * @property string $tanggal
 * @property string $no_rekmed
 * @property string $diagnosa
 * @property string $df
 * @property int $lengkap
 */
class Karj extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'karj';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['verived', 'lengkap'], 'integer'],
            [['tanggal'], 'safe'],
            [['no_rekmed', 'df'], 'string', 'max' => 50],
            [['diagnosa'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'verived' => 'Verived',
            'tanggal' => 'Tanggal',
            'no_rekmed' => 'No Rekmed',
            'diagnosa' => 'Diagnosa',
            'df' => 'Df',
            'lengkap' => 'Lengkap',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
}
