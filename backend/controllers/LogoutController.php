<?php

namespace cms\user\backend\controllers;

use yii\web\Controller;

/**
 * Logout controller
 */
class LogoutController extends Controller {

	public function actions() {
		return [
			'index' => 'cms\user\common\actions\Logout',
		];
	}

}
