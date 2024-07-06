<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kartustok_jenismutasi".
 *
 * @property int $id
 * @property string $jenismutasi
 */
class KartustokJenismutasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kartustok_jenismutasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenismutasi'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenismutasi' => 'Jenismutasi',
        ];
    }
}
