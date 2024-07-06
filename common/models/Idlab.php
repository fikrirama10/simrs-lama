<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "idlab".
 *
 * @property int $id
 * @property string $rm
 * @property string $idrawat
 * @property string $tanggal
 * @property string $ket
 */
class Idlab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'idlab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['rm', 'idrawat', 'ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rm' => 'Rm',
            'idrawat' => 'Idrawat',
            'tanggal' => 'Tanggal',
            'ket' => 'Ket',
        ];
    }
}
