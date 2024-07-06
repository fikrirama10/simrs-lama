<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "inaprm".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property string $tglpulang
 * @property string $tglskembali
 * @property int $pengembalian
 * @property int $kelengkapan
 * @property int $validator
 */
class Inaprm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inaprm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tglpulang', 'tglskembali'], 'safe'],
            [['pengembalian', 'kelengkapan', 'validator'], 'integer'],
            [['no_rekmed','nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rekmed' => 'No Rekmed',
            'tglpulang' => 'Tglpulang',
            'tglskembali' => 'Tglskembali',
            'pengembalian' => 'Pengembalian',
            'kelengkapan' => 'Kelengkapan',
            'validator' => 'Validator',
        ];
    }
}
