<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prosedur".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $idrawat
 * @property string $no_rekmed
 * @property string $tindakan
 * @property string $td
 * @property int $idpemeriksa
 */
class Prosedur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prosedur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['idpemeriksa'], 'integer'],
            [['idrawat', 'no_rekmed', 'td'], 'string', 'max' => 50],
            [['tindakan'], 'string', 'max' => 200],
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
            'idrawat' => 'Idrawat',
            'no_rekmed' => 'No Rekmed',
            'tindakan' => 'Tindakan',
            'td' => 'Td',
            'idpemeriksa' => 'Idpemeriksa',
        ];
    }
}
