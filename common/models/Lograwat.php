<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lograwat".
 *
 * @property int $id
 * @property int $idrawat
 * @property string $jenis
 * @property string $rm
 * @property string $kelas
 * @property string $waktu
 */
class Lograwat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lograwat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['waktu'], 'safe'],
            [['jenis', 'rm', 'kelas','idrawat'], 'string', 'max' => 50],
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
            'jenis' => 'Jenis',
            'rm' => 'Rm',
            'kelas' => 'Kelas',
            'waktu' => 'Waktu',
        ];
    }
}
