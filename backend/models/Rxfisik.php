<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rxfisik".
 *
 * @property int $id
 * @property string $no_rawat
 * @property string $rx_fisik
 * @property string $no_rekmed
 * @property int $tinggibadan
 * @property int $beratbadan
 * @property string $tekanandarah
 * @property int $kesadaran
 * @property int $keadaan
 * @property int $suhu
 * @property string $nadi
 * @property string $respirasi
 * @property string $gizi
 */
class Rxfisik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rxfisik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rx_fisik', 'gizi'], 'string'],
            [['tinggibadan', 'beratbadan', 'kesadaran', 'keadaan', 'suhu'], 'integer'],
            [['no_rawat', 'no_rekmed', 'tekanandarah', 'nadi', 'respirasi'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rawat' => 'No Rawat',
            'rx_fisik' => 'Rx Fisik',
            'no_rekmed' => 'No Rekmed',
            'tinggibadan' => 'Tinggibadan',
            'beratbadan' => 'Beratbadan',
            'tekanandarah' => 'Tekanandarah',
            'kesadaran' => 'Kesadaran',
            'keadaan' => 'Keadaan',
            'suhu' => 'Suhu',
            'nadi' => 'Nadi',
            'respirasi' => 'Respirasi',
            'gizi' => 'Gizi',
        ];
    }
}
