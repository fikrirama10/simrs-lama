<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jenistarif".
 *
 * @property int $id
 * @property string $jenistarif
 */
class Jenistarif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenistarif';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenistarif'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenistarif' => 'Jenistarif',
        ];
    }
}
