<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rencanaasuhan".
 *
 * @property int $id
 * @property int $idkategori
 * @property int $idintervensi
 * @property string $rencanaasuhan
 * @property string $keterangan
 *
 * @property MasalahKeperawatanIntervensi $intervensi
 * @property RencanaasuhanKategori $kategori
 */
class Rencanaasuhan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rencanaasuhan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkategori', 'idintervensi'], 'integer'],
            [['rencanaasuhan', 'keterangan'], 'string'],
            [['idintervensi'], 'exist', 'skipOnError' => true, 'targetClass' => MasalahKeperawatanIntervensi::className(), 'targetAttribute' => ['idintervensi' => 'id']],
            [['idkategori'], 'exist', 'skipOnError' => true, 'targetClass' => RencanaasuhanKategori::className(), 'targetAttribute' => ['idkategori' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idkategori' => 'Idkategori',
            'idintervensi' => 'Idintervensi',
            'rencanaasuhan' => 'Rencanaasuhan',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIntervensi()
    {
        return $this->hasOne(MasalahKeperawatanIntervensi::className(), ['id' => 'idintervensi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(RencanaasuhanKategori::className(), ['id' => 'idkategori']);
    }
}
