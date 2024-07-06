<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ppi".
 *
 * @property int $id
 * @property string $cucirtsbelum
 * @property string $cucitssudah
 * @property string $cucitsmcairan
 * @property string $cucistinfakan
 * @property int $idpetu
 * @property string $idrawat
 * @property string $rm
 * @property int $idjenisrawat
 */
class Ppi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ppi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cucirtsbelum', 'cucitssudah', 'cucitsmcairan', 'cucistinfakan'], 'string'],
            [['idpetu', 'idjenisrawat'], 'integer'],
            [['idrawat', 'rm'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cucirtsbelum' => 'Cucirtsbelum',
            'cucitssudah' => 'Cucitssudah',
            'cucitsmcairan' => 'Cucitsmcairan',
            'cucistinfakan' => 'Cucistinfakan',
            'idpetu' => 'Idpetu',
            'idrawat' => 'Idrawat',
            'rm' => 'Rm',
            'idjenisrawat' => 'Idjenisrawat',
        ];
    }
}
