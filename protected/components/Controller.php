<?php
class Controller extends CController {

	public $user;
	private $_email = 'admin@gmail.com';
	
	public function getEmail() {
		return $this->_email;
	}
	
	public function init()
	{
		if (!Yii::app()->user->isGuest) {
			$this->user = User::model()->findByPk(Yii::app()->user->id);
		} else {
			$this->user = new User();
		}
	}
}