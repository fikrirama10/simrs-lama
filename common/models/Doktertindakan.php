<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doktertindakan".
 *
 * @property int $id
 * @property string $idrawat
 * @property string $rm
 * @property string $tanggal
 */
class Doktertindakan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doktertindakan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['iddokter','idtkp'], 'integer'],
            [['idrawat', 'rm'], 'string', 'max' => 50],
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
            'rm' => 'Rm',
            'tanggal' => 'Tanggal',
        ];
    }
}
