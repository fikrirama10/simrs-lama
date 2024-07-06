<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "antibiotik".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $no_rekmed
 * @property string $idrawat
 * @property string $diagnosa
 * @property string $jenisae
 * @property int $dilakukan
 */
class Antibiotik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'antibiotik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['dilakukan'], 'integer'],
            [['no_rekmed', 'idrawat', 'jenisae'], 'string', 'max' => 50],
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
            'no_rekmed' => 'No Rekmed',
            'idrawat' => 'Idrawat',
            'diagnosa' => 'Diagnosa',
            'jenisae' => 'Jenisae',
            'dilakukan' => 'Dilakukan',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }	
}
