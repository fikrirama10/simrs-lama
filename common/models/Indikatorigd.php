<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "indikatorigd".
 *
 * @property int $id
 * @property string $namapetugas
 * @property string $jab
 * @property int $bls
 * @property string $blsterbit
 * @property string $blshabis
 * @property int $ppgd
 * @property string $ppgdterbit
 * @property string $ppgdhabis
 * @property int $gels
 * @property string $gelsterbit
 * @property string $gelshabis
 * @property int $als
 * @property string $alsterbit
 * @property string $alshabis
 * @property int $ket
 */
class Indikatorigd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indikatorigd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jab'], 'string'],
            [['bls', 'ppgd', 'gels', 'als', 'ket'], 'integer'],
            [['blsterbit', 'blshabis', 'ppgdterbit', 'ppgdhabis', 'gelsterbit', 'gelshabis', 'alsterbit', 'alshabis'], 'safe'],
            [['namapetugas'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namapetugas' => 'Namapetugas',
            'jab' => 'Jab',
            'bls' => 'Bls',
            'blsterbit' => 'Blsterbit',
            'blshabis' => 'Blshabis',
            'ppgd' => 'Ppgd',
            'ppgdterbit' => 'Ppgdterbit',
            'ppgdhabis' => 'Ppgdhabis',
            'gels' => 'Gels',
            'gelsterbit' => 'Gelsterbit',
            'gelshabis' => 'Gelshabis',
            'als' => 'Als',
            'alsterbit' => 'Alsterbit',
            'alshabis' => 'Alshabis',
            'ket' => 'Ket',
        ];
    }
}
