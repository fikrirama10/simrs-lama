<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usgdetail".
 *
 * @property int $id
 * @property string $idusg
 * @property int $idpemeriksaan
 * @property string $klinis
 * @property string $hasil
 * @property string $tgl
 * @property string $nousg
 * @property int $status
 *
 * @property Dafusg $pemeriksaan
 */
class Usgdetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usgdetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpemeriksaan', 'status'], 'integer'],
            [['idpemeriksaan'], 'required'],
            [['klinis', 'hasil','kesimpulan','judul'], 'string'],
            [['tgl'], 'safe'],
            [['idusg', 'nousg'], 'string', 'max' => 50],
            [['idpemeriksaan'], 'exist', 'skipOnError' => true, 'targetClass' => Dafusg::className(), 'targetAttribute' => ['idpemeriksaan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idusg' => 'Idusg',
            'idpemeriksaan' => 'Idpemeriksaan',
            'klinis' => 'Klinis',
            'hasil' => 'Hasil',
            'tgl' => 'Tgl',
            'nousg' => 'Nousg',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaan()
    {
        return $this->hasOne(Dafusg::className(), ['id' => 'idpemeriksaan']);
    }
}
