<?php

namespace cms\user\backend\models;

use Yii;
use yii\base\Model;

/**
 * Password setting form
 */
class PasswordForm extends Model
{

	/**
	 * @var string 
	 */
	public $password;

	/**
	 * @var string 
	 */
	public $confirm;

	/**
	 * @var boolean
	 */
	public $passwordChange;

	/**
	 * @var cms\user\common\models\User 
	 */
	private $_object;

	/**
	 * @inheritdoc
	 * @param cms\user\common\models\User $object 
	 */
	public function __construct(\cms\user\common\models\User $object, $config = [])
	{
		$this->_object = $object;

		parent::__construct($config);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'password' => Yii::t('user', 'Password'),
			'confirm' => Yii::t('user', 'Confirm'),
			'passwordChange' => Yii::t('user', 'User must change password at next login'),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['password', 'string', 'min' => 4],
			['confirm', 'compare', 'compareAttribute' => 'password'],
			['passwordChange', 'boolean'],
			[['password', 'confirm'], 'required'],
		];
	}

	/**
	 * User name getter
	 * @return string
	 */
	public function getUsername()
	{
		return $this->_object->getUsername();
	}

	/**
	 * Change password
	 * @return boolean
	 */
	public function changePassword()
	{
		if (!$this->validate())
			return false;

		$object = $this->_object;

		$object->setPassword($this->password);
		$object->passwordChange = $this->passwordChange == 0 ? false : true;

		if (!$object->save(false))
			return false;

		return true;
	}

}
