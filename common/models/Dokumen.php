<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dokumen".
 *
 * @property integer $Id
 * @property string $Kode
 * @property string $Judul
 * @property integer $IdKat
 * @property integer $IdJenis
 * @property integer $IdType
 * @property string $FileName
 * @property integer $FileSize
 * @property string $FileExt
 * @property integer $Requested
 * @property string $Publisher
 * @property integer $IdStat
 * @property string $PublishDate
 * @property string $Deskripsi
 * @property string $UserId
 * @property string $IdSKPD
 * @property string $Keterangan
 *
 * @property DokumenJenis $idJenis
 * @property DokumenKategori $idKat
 * @property DokumenStatus $idStat
 * @property DokumenType $idType
 */
class Dokumen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dokumen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdKat', 'IdJenis', 'IdType', 'FileSize', 'Requested', 'IdStat'], 'integer'],
            [['PublishDate'], 'required'],
            [['PublishDate'], 'safe'],
            [['Deskripsi'], 'string'],
            [['Kode'], 'string', 'max' => 20],
            [['Judul','Publisher', 'Keterangan'], 'string', 'max' => 255],
            [['FileExt', 'IdSKPD'], 'string', 'max' => 10],
			[['FileName'], 'file', 'extensions'=>'jpg,gif,png,pdf,xps,doc,docx,xls,xlsx,ppt,pptx,rar,zip,jpeg,mp3,wav,txt','skipOnEmpty' => true],
            [['UserId'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Kode' => 'Kode',
            'Judul' => 'Judul',
            'IdKat' => 'Id Kat',
            'IdJenis' => 'Id Jenis',
            'IdType' => 'Id Type',
            'FileName' => 'File Name',
            'FileSize' => 'File Size',
            'FileExt' => 'File Ext',
            'Requested' => 'Requested',
            'Publisher' => 'Publisher',
            'IdStat' => 'Id Stat',
            'PublishDate' => 'Publish Date',
            'Deskripsi' => 'Deskripsi',
            'UserId' => 'User ID',
            'IdSKPD' => 'Id Skpd',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenis()
    {
        return $this->hasOne(DokumenJenis::className(), ['Id' => 'IdJenis']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(DokumenKategori::className(), ['Id' => 'IdKat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(DokumenStatus::className(), ['Id' => 'IdStat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(DokumenType::className(), ['Id' => 'IdType']);
    }

	public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'UserId']);
    }
	
	public function genKode()
	{
		$prefix=Yii::$app->params['IdPPID'];
		$max = $this::find()->select('max(Kode)')->andFilterWhere(['like','Kode',$prefix])->scalar(); 
		
		if ($max != ''){
			$last=substr($max,5,8)+1;
			if($last<10){
				$id=$prefix.'000000'.$last;}
			elseif($last<100){
				$id=$prefix.'00000'.$last;}
			elseif($last<1000){
				$id=$prefix.'0000'.$last;}
			elseif($last<10000){
				$id=$prefix.'000'.$last;}
			elseif($last<100000){
				$id=$prefix.'00'.$last;}
			elseif($last<1000000){
				$id=$prefix.'0'.$last;}
			elseif($last<10000000){
				$id=$prefix.$last;}
		}
		else{
			$id=$prefix.'0000001';
		}
		
		return $this->Kode=$id;
	}
	
	public function getMostDownload($limit){
		return $this->find()->orderBy(['Requested' => SORT_DESC])->limit($limit)->all();
	}
	
	public function getLatest($limit){
		return $this->find()->orderBy(['Id' => SORT_DESC])->limit($limit)->all();
	}
	
}
