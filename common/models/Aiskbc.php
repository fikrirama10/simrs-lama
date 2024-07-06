<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "aiskbc".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property string $tanggal
 * @property int $sesuaiindikasi
 * @property int $apdtepat
 * @property int $alatsteril
 * @property int $hh
 * @property int $dilepas
 * @property int $pengisianbalon
 * @property int $fiksasi
 * @property int $urine
 */
class Aiskbc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aiskbc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['sesuaiindikasi', 'apdtepat', 'alatsteril', 'hh', 'dilepas', 'pengisianbalon', 'fiksasi', 'urine'], 'integer'],
            [['no_rekmed'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rekmed' => 'No Rekmed',
            'tanggal' => 'Tanggal',
            'sesuaiindikasi' => 'Sesuaiindikasi',
            'apdtepat' => 'Apdtepat',
            'alatsteril' => 'Alatsteril',
            'hh' => 'Hh',
            'dilepas' => 'Dilepas',
            'pengisianbalon' => 'Pengisianbalon',
            'fiksasi' => 'Fiksasi',
            'urine' => 'Urine',
        ];
    }
}
