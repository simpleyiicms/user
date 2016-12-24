<?php

namespace cms\users\common\models;

use Yii;
use yii\base\Model;

use cms\users\common\models\User;

/**
 * User login form model
 */
class LoginForm extends Model
{

	/**
	 * @var string User e-mail
	 */
	public $email;

	/**
	 * @var string User password
	 */
	public $password;

	/**
	 * @var boolean Remember me option
	 */
	public $rememberMe;

	/**
	 * @var cms\users\common\models\User
	 */
	private $_user = false;

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'email' => Yii::t('users', 'E-mail'),
			'password' => Yii::t('users', 'Password'),
			'rememberMe' => Yii::t('users', 'Remember me'),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['email', 'password'], 'required'],
			['rememberMe', 'boolean'],
			['password', 'validatePassword'],
			['email', 'validateActive'],
		];
	}

	/**
	 * Check that user is active
	 * @param string $attribute 
	 * @param array $params 
	 * @return void
	 */
	public function validateActive($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();

			if ($user && !$user->active) {
				$this->addError($attribute, Yii::t('users', 'User is blocked.'));
			}
		}
	}

	/**
	 * Check password
	 * @param string $attribute 
	 * @param array $params 
	 * @return void
	 */
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();

			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, Yii::t('users', 'Incorrect username or password.'));
			}
		}
	}

	/**
	 * Login
	 * @return boolean
	 */
	public function login()
	{
		if (!$this->validate())
			return false;

		return $this->getUser()->login($this->rememberMe ? 3600*24*30 : 0);
	}

	/**
	 * User getter
	 * @return cms\users\common\models\User
	 */
	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = User::findByEmail($this->email);
		}

		return $this->_user;
	}

}
