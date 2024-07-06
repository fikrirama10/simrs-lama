<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gagalfoto".
 *
 * @property int $id
 * @property int $jumlah
 * @property int $tanggal
 * @property int $gagal
 * @property string $jenisfoto
 * @property int $validator
 */
class Gagalfoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gagalfoto';
    }
	
	public function Pecah($id){
	$data = json_decode($id);
		return implode(" , ",$data); 
			// for($i=0; $i < count($data); $i++){
				  // $array = $data[$i].',';
				  // echo $array;
				  
			// }
			//echo $data;
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jumlah','gagal', 'validator'], 'integer'],
            [['tanggal','jenisfoto'], 'safe'],
            //[[], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jumlah' => 'Jumlah',
            'tanggal' => 'Tanggal',
            'gagal' => 'Gagal',
            'jenisfoto' => 'Jenisfoto',
            'validator' => 'Validator',
        ];
    }
	public function getPeriksa()
    {
        return $this->hasOne(Dafrad::className(), ['id' => 'jenisfoto']);
    }
}
