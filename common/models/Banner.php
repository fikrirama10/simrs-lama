<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string $judul
 * @property string $deskripsi
 * @property string $ket
 * @property string $gambar
 * @property string $tglupdate
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deskripsi', 'ket'], 'string'],
            [['tglupdate'], 'safe'],
            [['judul'], 'string', 'max' => 100],
            [['gambar'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
            'ket' => 'Ket',
            'gambar' => 'Gambar',
            'tglupdate' => 'Tglupdate',
        ];
    }
}
