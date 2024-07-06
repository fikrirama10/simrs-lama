<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diagnosapasien".
 *
 * @property int $id
 * @property string $idrawat
 * @property string $tgldiagnosa
 * @property string $rm
 * @property string $idpoli
 * @property int $iddokter
 * @property string $ket
 * @property string $jenis_kelamin
 * @property int $idjenisrawat
 * @property int $idkel
 * @property string $koddiagnosa
 *
 * @property Rawatjalan $rawat
 */
class Diagnosapasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnosapasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgldiagnosa'], 'safe'],
            [['iddokter', 'idjenisrawat', 'idkel'], 'integer'],
            [['jenis_kelamin'], 'string'],
            [['idrawat', 'rm', 'idpoli', 'ket', 'koddiagnosa'], 'string', 'max' => 50],
            [['idrawat'], 'exist', 'skipOnError' => true, 'targetClass' => Rawatjalan::className(), 'targetAttribute' => ['idrawat' => 'idrawat']],
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
            'tgldiagnosa' => 'Tgldiagnosa',
            'rm' => 'Rm',
            'idpoli' => 'Idpoli',
            'iddokter' => 'Iddokter',
            'ket' => 'Ket',
            'jenis_kelamin' => 'Jenis Kelamin',
            'idjenisrawat' => 'Idjenisrawat',
            'idkel' => 'Idkel',
            'koddiagnosa' => 'Koddiagnosa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRawat()
    {
        return $this->hasOne(Rawatjalan::className(), ['idrawat' => 'idrawat']);
    }
}
