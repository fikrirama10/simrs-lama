<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ppi".
 *
 * @property int $id
 * @property string $momen1
 * @property string $momen2
 * @property string $momen3
 * @property string $momen4
 * @property string $momen5
 * @property int $ipcln
 * @property string $unit
 * @property string $person
 */
class Ppi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
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
            [['momen1', 'momen2','total', 'momen3', 'momen4', 'momen5'], 'integer'],
            [['ipcln'], 'integer'],
            [['unit', 'person'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'momen1' => 'Momen1',
            'momen2' => 'Momen2',
            'momen3' => 'Momen3',
            'momen4' => 'Momen4',
            'momen5' => 'Momen5',
            'ipcln' => 'Ipcln',
            'unit' => 'Unit',
            'person' => 'Person',
        ];
    }
 public function getIpc()
    {
        return $this->hasOne(Ipcln::className(), ['id' => 'ipcln']);
    }
	 public function getUni()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit']);
    }
function weekNumberOfMonth($date) {

$tgl=date_parse($date);

$tanggal =  $tgl['day'];

$bulan   =  $tgl['month'];

$tahun   =  $tgl['year'];

//tanggal 1 tiap bulan

$tanggalAwalBulan = mktime(0, 0, 0, $bulan, 1, $tahun);

$mingguAwalBulan = (int) date('W', $tanggalAwalBulan);

//tanggal sekarang

$tanggalYangDicari = mktime(0, 0, 0, $bulan, $tanggal, $tahun);

$mingguTanggalYangDicari = (int) date('W', $tanggalYangDicari);

$mingguKe = $mingguTanggalYangDicari - $mingguAwalBulan + 1;

return $mingguKe;}


}
