<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tindakandokter".
 *
 * @property int $id
 * @property string $kode_rawat
 * @property int $idtindakan
 * @property int $tarif
 * @property int $penindak
 * @property string $ditindakoleh
 */
class Tindakandokter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tindakandokter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtindakan', 'tarif', 'penindak'], 'integer'],
            [['kode_rawat', 'ditindakoleh'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_rawat' => 'Kode Rawat',
            'idtindakan' => 'Idtindakan',
            'tarif' => 'Tarif',
            'penindak' => 'Penindak',
            'ditindakoleh' => 'Ditindakoleh',
        ];
    }
}
