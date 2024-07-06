<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_ranap_lab".
 *
 * @property int $id
 * @property int $idrawat
 * @property int $idpemeriksaan
 * @property string $tanggal
 * @property int $iddokter
 * @property int $idtindakan
 * @property int $status
 */
class PemeriksaanRanapLab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_ranap_lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'idpemeriksaan', 'iddokter', 'idtindakan', 'status'], 'integer'],
            [['tanggal'], 'safe'],
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
            'idpemeriksaan' => 'Idpemeriksaan',
            'tanggal' => 'Tanggal',
            'iddokter' => 'Iddokter',
            'idtindakan' => 'Idtindakan',
            'status' => 'Status',
        ];
    }
}
