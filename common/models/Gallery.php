<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property int $tampilkan
 * @property string $gambar
 * @property int $idver
 * @property string $tanggal
 * @property string $judul
 * @property string $deskripsi
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tampilkan', 'idver'], 'integer'],
            [['tanggal'], 'safe'],
            [['deskripsi'], 'string'],
            [['gambar'], 'string', 'max' => 150],
            [['judul'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tampilkan' => 'Tampilkan',
            'gambar' => 'Gambar',
            'idver' => 'Idver',
            'tanggal' => 'Tanggal',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
