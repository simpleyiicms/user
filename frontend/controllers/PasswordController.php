<?php

namespace cms\user\frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Password change controller
 */
class PasswordController extends Controller
{

	/**
	 * @inheritdoc
	 */
	public function actions() {
		return [
			'index' => 'cms\user\common\actions\Password',
		];
	}

}
