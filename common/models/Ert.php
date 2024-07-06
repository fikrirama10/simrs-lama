<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ert".
 *
 * @property int $id
 * @property string $tanggal
 * @property int $usia
 * @property string $no_rekmed
 * @property string $diagnosa
 * @property string $jamdatang
 * @property string $idrawat
 * @property int $idvalidator
 * @property string $jamdilayani
 * @property int $sesuai
 */
class Ert extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'ert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'jamdatang', 'jamdilayani'], 'safe'],
            [['usia', 'idvalidator', 'sesuai'], 'integer'],
            [['no_rekmed', 'idrawat'], 'string', 'max' => 50],
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
            'tanggal' => 'Tanggal',
            'usia' => 'Usia',
            'no_rekmed' => 'No Rekmed',
            'diagnosa' => 'Diagnosa',
            'jamdatang' => 'Jamdatang',
            'idrawat' => 'Idrawat',
            'idvalidator' => 'Idvalidator',
            'jamdilayani' => 'Jamdilayani',
            'sesuai' => 'Sesuai',
        ];
    }
	  public function getPasien()
    {
	return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
	}

}
