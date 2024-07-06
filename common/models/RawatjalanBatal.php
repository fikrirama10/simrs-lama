<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rawatjalan_batal".
 *
 * @property int $id
 * @property int $idrawat
 * @property string $no_rekmed
 * @property string $ket
 * @property int $idbayar
 * @property int $iduser
 * @property string $tgldaftar
 * @property string $tglcreate
 */
class RawatjalanBatal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rawatjalan_batal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'idrawat', 'idbayar', 'iduser'], 'integer'],
            [['ket'], 'string'],
            [['tgldaftar', 'tglcreate'], 'safe'],
            [['no_rekmed'], 'string', 'max' => 50],
            [['id'], 'unique'],
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
            'no_rekmed' => 'No Rekmed',
            'ket' => 'Ket',
            'idbayar' => 'Idbayar',
            'iduser' => 'Iduser',
            'tgldaftar' => 'Tgldaftar',
            'tglcreate' => 'Tglcreate',
        ];
    }
}
