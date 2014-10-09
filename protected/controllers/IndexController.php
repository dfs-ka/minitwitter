<?php
class IndexController extends Controller
{
	public $layout = 'index';
	
	/**
	 * Main page. New post and view posts
	 * @post send
	 * @post msg
	 */
	public function actionIndex()
	{
		$msg = (isset($_POST['msg'])) ? $_POST['msg'] : '';
		$error = array();
		if(isset($_POST['send'])) {
			if(strlen($msg) <= 0 || strlen($msg) > 200) {
				$error[] = 'Incorrect message length ('.strlen($msg).'/200)';
			} else {
				$post = new Post();
				$post->user_id = $this->user->id;
				$post->msg = $msg;
				$post->time = time();
				$post->save();
				$msg = '';
			}
		}
		
		$posts = Yii::app()->db->createCommand()
				->select('p.id, p.msg, DATE_FORMAT(FROM_UNIXTIME(p.time), "%d.%m %H:%i") as date, u.id as uid, u.username')
				->from('post p')
				->join('user u', 'u.id=p.user_id')
				->order('p.time DESC')
				->queryAll();

		$this->render('index', array('posts' => $posts, 'error' => $error, 'msg' => $msg));
	}
	
	/**
	 * Edit post
	 * AJAX
	 * @post post_id
	 * @post msg
	 */
	public function actionEdit()
	{
		$result['status'] = false;
		if(isset($_POST['post_id'])) {
			if(strlen($_POST['msg']) <= 0 || strlen($_POST['msg']) > 200) {
				$result['error'] = 'Wrong post length.';
			} else {
				if($post = Post::model()->find("id = :id AND user_id = :user_id", array(':id' => $_POST['post_id'], ':user_id' => $this->user->id))) {
					/*$post->msg = $_POST['msg'];
					$post->save;*/
					$result['status'] = true;
				} else {
					$result['error'] = 'Error! You don\'t have permission to delete this post.';
				}
			}
		}
		echo json_encode($result);
	}
	
	/**
	 * Delete post
	 * AJAX
	 * @post post_id
	 */
	public function actionDelete()
	{
		$result['status'] = false;
		if(isset($_POST['post_id'])) {
			if($post = Post::model()->find("id = :id AND user_id = :user_id", array(':id' => $_POST['post_id'], ':user_id' => $this->user->id))) {
				$post->delete();
				$result['status'] = true;
			}
		}
		echo json_encode($result);
	}
	
	/**
	 * Login
	 * @post send
	 * @post username
	 * @post password
	 */
	public function actionLogin()
	{
		$error = array();
		if(isset($_POST['send'])) {
			if(!$user = User::model()->find("username = :username", array(':username' => $_POST['username']))) {
				$error[] = 'User not found';
				$this->render('login', array('error' => $error));
				Yii::app()->end();
			}
			if($user->password != md5($_POST['password'])) {
				$error[] = 'Wrong username or password';
				$this->render('login', array('error' => $error));
				Yii::app()->end();
			}
		
			$this->user->username = $_POST['username'];
			$this->user->password = $_POST['password'];
			
			$this->user->authenticate();
			$this->redirect(Yii::app()->homeUrl);
		}
		
		$this->render('login', array('error' => $error));
	}	
	
	/**
	 * Logout
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->user->returnUrl);
	}
	
	/**
	 * Registration
	 * @post send
	 * @post username
	 * @post password
	 */
	public function actionRegistration()
	{
		if (!Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->homeUrl);
		}
		$error = array();
		if(isset($_POST['send'])) {
			$this->user->username = $_POST['username'];
			$this->user->password = $_POST['password'];
			$error = CActiveForm::validate($this->user);
			$error = json_decode($error, true);
			if(!count($error)) {
				if(User::model()->find("username = :username", array(':username' => $this->user->username))) {
					$error[] = 'User already exists';
				} else {
					$this->user->password = md5($_POST['password']);
					$this->user->save();
					$this->user->password = $_POST['password'];
					$this->user->authenticate();
					
					Yii::app()->getModule('email');
					$email = new Email;
					$email->from = $this->getEmail();
					$email->layout = 'common';
					$email->type = 'text/html';
					$email->to = $this->getEmail();
					$email->subject = 'New user registered!';
					$email->view = 'newuser';
					$email->send(array('username'=>$this->user->username));
					
					$this->redirect(Yii::app()->homeUrl);
				}
			} else {
				$temp = array();
				foreach($error as $e) {
					if(is_array($e)) {
						foreach($e as $v) {
							$temp[] = $v;
						}
					} else {
						$temp[] = $e;
					}
				}
				$error = $temp;
			}
		}
		
		$this->render('registration', array('error' => $error));
	}
}
