<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_ugddiagsekunder".
 *
 * @property int $id
 * @property int $idpemeriksaan
 * @property int $idrawat
 * @property string $diagnosaprimer
 * @property string $diagnosasekunder
 */
class PemeriksaanUgddiagsekunder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_ugddiagsekunder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpemeriksaan', 'idrawat'], 'integer'],
            [['diagnosaprimer', 'diagnosasekunder'], 'string', 'max' => 250],
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
            'diagnosaprimer' => 'Diagnosaprimer',
            'diagnosasekunder' => 'Diagnosasekunder',
        ];
    }
}
