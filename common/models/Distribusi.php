<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "distribusi".
 *
 * @property int $id
 * @property string $nodistri
 * @property string $tanggal
 * @property string $ket
 * @property int $user
 * @property string $tempat
 */
class Distribusi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distribusi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['user'], 'integer'],
            [['tempat'], 'string'],
            [['nodistri', 'ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nodistri' => 'Nodistri',
            'tanggal' => 'Tanggal',
            'ket' => 'Ket',
            'user' => 'User',
            'tempat' => 'Tempat',
        ];
    }
}
