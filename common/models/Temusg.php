<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "temusg".
 *
 * @property int $id
 * @property string $hasil
 * @property string $kesimpulan
 * @property string $judul
 */
class Temusg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'temusg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hasil', 'kesimpulan'], 'string'],
            [['judul'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hasil' => 'Hasil',
            'kesimpulan' => 'Kesimpulan',
            'judul' => 'Judul',
        ];
    }
}
