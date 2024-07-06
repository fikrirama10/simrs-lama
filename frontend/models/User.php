<?php

namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "user".
 *
 * @property integer $Id
 * @property string $Username
 * @property string $Authkey
 * @property string $Password
 * @property string $PasswordResetToken
 * @property string $Email
 * @property integer $IdPriv
 * @property string $MemberId
 * @property integer $Created
 * @property integer $LastUpdate
 * @property string $LastIP
 *
 * @property UserPriviledges $idPriv
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
		 return [
            [['username', 'auth_key', 'password', 'email', 'created_at', 'updated_at'], 'required'],
            [['idpriv', 'status', 'created_at', 'updated_at'], 'integer'],
            [['kode_petugas'], 'string', 'max' => 50],
            [['username', 'password', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key','kode_petugas','statas'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['idpriv'], 'exist', 'skipOnError' => true, 'targetClass' => Privilages::className(), 'targetAttribute' => ['idpriv' => 'idpriv']],
			['password_repeat', 'required'],
			['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ]
        ];
        // return [
            // [['Username', 'Authkey', 'Password', 'Email'], 'required'],
            // [['IdPriv', 'Created', 'LastUpdate'], 'integer'],

            // ['Username', 'trim'],
			// [['Username'], 'unique','targetClass'=>'\common\models\User','message' => 'This username has already been taken.'],
            // ['Username', 'string', 'min' => 2, 'max' => 255],
			
            // ['Email', 'trim'],
            // ['Email', 'email'],
            // ['Email', 'string', 'max' => 255],
            // ['Email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
			
			// ['Password', 'required'],
			// ['Password', 'string', 'min' => 6],
			// ['PasswordRepeat', 'required'],
			// ['PasswordRepeat', 'compare', 'compareAttribute'=>'Password', 'message'=>"Passwords don't match" ],
			
            // [['Authkey'], 'string', 'max' => 32],
            // [['MemberId'], 'string', 'max' => 18],
            // [['LastIP'], 'string', 'max' => 24],
			            
			// [['PasswordResetToken'], 'unique'],
            // [['PasswordResetToken'], 'string', 'max' => 255]
        // ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
         return [
            'id' => 'ID',
            'kode_petugas' => 'Kode Petugas',
            'password_repeat' => 'Repeat Password',
            'username' => 'Username',
            'idpriv' => 'Idpriv',
            'auth_key' => 'Auth Key',
            'password' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

	// public function validateExist($attribute) {
	// if (!User::model()->exists(['Email'=>$attribute]))
		// $this->addError($attribute, 'Sorry, you\'re already using that name for another list.');
	// }
	
    public function getPriviledges()
    {
        return $this->hasOne(Privilages::className(), ['idpriv' => 'idpriv']);
    }

	public function getPegawai(){
		return $this->hasOne(Petugas::className(), ['kode_petugas' => 'kode_petugas']);
	}
	public function getDokter(){
		return $this->hasOne(Dokter::className(), ['kodedokter' => 'kode_petugas']);
	}

	public function findUserByMemberId($mid)
	{
		return $this::findOne(['MemberId' => $mid]);
	}
	
	public static function findIdentity($id)
{
    $session = Yii::$app->session;
    return ($session->has('user')) ? new static($session->get('user')) : null;
}
	
	public static function findIdentityByAccessToken($token, $type = null)
{
    //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    return static::findOne(['auth_key' => $token,]);
}
	
	public static function findByUsername($username)
	{
		return static::findOne(['username'=>$username]);
	}
	
	public static function findbyPasswordResetToken($token)
	{
		$expire = \Yii::$app->params['user.PasswordResetTokenExpire'];
		$parts = explode('_',$token);
		$timestamp = (int) end($parts);
		if ($timestamp + $expire < time()){
			//token expired
			return null;
		}
		return static::findOne(['password_reset_token' => $token]);
	}
	
	public function getId()
	{
		return $this->getPrimaryKey();
	}
	
	public function getAuthKey()
	{
		return $this->auth_key;
	}
	
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey()==$authKey;
	}
	
	public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
	
	public function setPassword($password)
    {
        $this->password= Yii::$app->security->generatePasswordHash($password);
    }
	
	public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
	
	public function generatePasswordResetToken()
    {
        $this->PasswordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }
	
	public function removePasswordResetToken()
	{
		$this->PasswordResetToken = null;
	}
	
}
