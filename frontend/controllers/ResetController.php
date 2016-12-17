<?php

namespace cms\user\frontend\controllers;

use Yii;
use yii\web\Controller;
use cms\user\frontend\models\PasswordResetRequestForm;
use cms\user\frontend\models\PasswordResetForm;

/**
 * Reset password controller
 */
class ResetController extends Controller {

	/**
	 * Reset password request
	 * @return void
	 */
	public function actionRequest() {
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('user', 'On the specified e-mail was sent an instructions to reset your password.'));

				return $this->refresh();
			} else {
				Yii::$app->getSession()->setFlash('error', Yii::t('user', 'Failed to send an email to reset your password.'));
			}
		}

		return $this->render('request', [
			'model' => $model,
		]);
	}

	/**
	 * Password reset
	 * @param string $token 
	 * @return void
	 */
	public function actionPassword($token) {
		try {
			$model = new PasswordResetForm($token);
		} catch (InvalidParamException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
			Yii::$app->getSession()->setFlash('success', Yii::t('user', 'The new password has been set.'));

			return $this->redirect(['login/index']);
		}

		return $this->render('password', [
			'model' => $model,
		]);
	}

}
