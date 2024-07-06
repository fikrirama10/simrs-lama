<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rencanaasuhan_keperawatan".
 *
 * @property int $id
 * @property int $idrawat
 * @property int $idmasalah
 * @property int $idintervensi
 * @property int $iduser
 * @property string $tgl
 */
class RencanaasuhanKeperawatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rencanaasuhan_keperawatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'idmasalah', 'idintervensi', 'iduser'], 'integer'],
            [['tgl'], 'safe'],
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
            'idmasalah' => 'Idmasalah',
            'idintervensi' => 'Idintervensi',
            'iduser' => 'Iduser',
            'tgl' => 'Tgl',
        ];
    }
}
