<?php
class User extends CActiveRecord
{   
	private $_identity;
	
	public function init()
	{
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'user';
	}	
	
    public function authenticate()
    {
        $this->_identity = new UserIdentity($this->username,$this->password);
        if($this->_identity->authenticate()) {
			Yii::app()->user->login($this->_identity,3600*24*7);
		} else {
			echo $this->_identity->errorMessage;
		}
    }	
	
	public function rules()
	{
		return array(
			array('username', 'length', 'max'=>30, 'min' => 3),
			array('password', 'length', 'max'=>128, 'min' => 3),
			array('username, password', 'required'),
		);
	}
	
	public function safeAttributes()
	{
		return array('username', 'password');
	}

	public function attributeLabels()
	{
		return array(
			'username'  => 'Username',
			'password'  => 'Password',
		);
	}
	
    public function relations()
    {
        return array(
        );
    }
}