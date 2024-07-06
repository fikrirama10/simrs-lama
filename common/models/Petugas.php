<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "petugas".
 *
 * @property integer $id
 * @property string $kode_petugas
 * @property string $nama_petugas
 * @property string $nohp
 * @property integer $alamat
 * @property string $jk
 * @property string $foto
 */
class Petugas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'petugas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
         
            [['jk'], 'string'],
            [['kode_petugas', 'nama_petugas', 'nohp','alamat', 'foto'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_petugas' => 'Kode Petugas',
            'nama_petugas' => 'Nama Petugas',
            'nohp' => 'Nohp',
            'alamat' => 'Alamat',
            'jk' => 'Jk',
            'foto' => 'Foto',
        ];
    }
		public function genKodeu()
	{
		$pf='RSAU';
		$max = $this::find()->select('max(kode_petugas)')->andFilterWhere(['like','kode_petugas',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->kode_petugas=$id;
		
	}
}
