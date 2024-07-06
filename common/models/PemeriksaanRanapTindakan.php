<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_ranap_tindakan".
 *
 * @property int $id
 * @property int $idpemeriksaan
 * @property int $idrawat
 * @property string $tanggal
 * @property int $iddokter
 * @property int $idtindakan
 * @property int $status
 */
class PemeriksaanRanapTindakan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_ranap_tindakan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpemeriksaan', 'idrawat', 'iddokter', 'idtindakan', 'status'], 'integer'],
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
            'idpemeriksaan' => 'Idpemeriksaan',
            'idrawat' => 'Idrawat',
            'tanggal' => 'Tanggal',
            'iddokter' => 'Iddokter',
            'idtindakan' => 'Idtindakan',
            'status' => 'Status',
        ];
    }
}
