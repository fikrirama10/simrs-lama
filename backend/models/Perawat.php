<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perawat".
 *
 * @property int $id
 * @property string $kodeperawat
 * @property string $jk
 * @property string $nama
 * @property string $nohp
 */
class Perawat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perawat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jk'], 'string'],
            [['kodeperawat', 'nama', 'nohp'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodeperawat' => 'Kodeperawat',
            'jk' => 'Jk',
            'nama' => 'Nama',
            'nohp' => 'Nohp',
        ];
    }
}
