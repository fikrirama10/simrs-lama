<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mcutni".
 *
 * @property int $id
 * @property string $nama
 * @property string $nofoto
 * @property string $notes
 * @property int $usia
 */
class Mcutni extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mcutni';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usia','status'], 'integer'],
			[['pemeriksaan', 'kualifikasi','kesan'], 'string'],
            [['nama', 'nofoto', 'notes'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'nofoto' => 'Nofoto',
            'notes' => 'Notes',
            'usia' => 'Usia',
        ];
    }
}
