<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "indirawat".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property string $diagnosa
 * @property int $dpjptcp
 * @property int $pkmcp
 * @property string $tanggal
 * @property int $verived
 */
class Indirawat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indirawat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dpjptcp', 'pkmcp', 'verived'], 'integer'],
            [['tanggal'], 'safe'],
            [['no_rekmed'], 'string', 'max' => 50],
            [['diagnosa'], 'string', 'max' => 190],
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
            'diagnosa' => 'Diagnosa',
            'dpjptcp' => 'Dpjptcp',
            'pkmcp' => 'Pkmcp',
            'tanggal' => 'Tanggal',
            'verived' => 'Verived',
        ];
    }
}
