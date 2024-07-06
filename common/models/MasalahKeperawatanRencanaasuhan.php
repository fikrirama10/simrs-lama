<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masalah_keperawatan_rencanaasuhan".
 *
 * @property int $id
 * @property int $idrawat
 * @property int $idmasalah
 * @property int $iddetail
 * @property int $idintervensi
 * @property int $idrencana
 * @property string $keterangan
 * @property int $iduser
 * @property int $idkategorirencana
 */
class MasalahKeperawatanRencanaasuhan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'masalah_keperawatan_rencanaasuhan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'idmasalah', 'iddetail', 'idintervensi', 'idrencana', 'iduser', 'idkategorirencana'], 'integer'],
            [['keterangan'], 'string'],
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
            'iddetail' => 'Iddetail',
            'idintervensi' => 'Idintervensi',
            'idrencana' => 'Idrencana',
            'keterangan' => 'Keterangan',
            'iduser' => 'Iduser',
            'idkategorirencana' => 'Idkategorirencana',
        ];
    }
	public function getRencana()
    {
        return $this->hasOne(Rencanaasuhan::className(), ['id' => 'idrencana']);
    }
}
