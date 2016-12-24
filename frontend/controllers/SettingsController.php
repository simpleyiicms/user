<?php

namespace cms\user\frontend\controllers;

use Yii;
use yii\web\Controller;

use cms\user\frontend\models\SettingsForm;

/**
 * User settings controller
 */
class SettingsController extends Controller
{

	/**
	 * Settings editting
	 * @return void
	 */
	public function actionIndex()
	{
		$user = Yii::$app->getUser();

		if ($user->isGuest)
			return $this->goHome();

		$model = new SettingsForm($user->getIdentity());

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Changes saved successfully.'));
		}

		return $this->render('index', [
			'model' => $model,
		]);
	}

	/**
	 * Confirm e-mail
	 * @return void
	 */
	public function actionConfirm()
	{
		$user = Yii::$app->getUser();

		if ($user->isGuest)
			return $this->goHome();

		$object = $user->getIdentity();

		if ($object->sendConfirmEmail()) {
			Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Confirm message was sent on the specified E-mail.'));
		} else {
			Yii::$app->getSession()->setFlash('danger', Yii::t('user', 'Failed to send a confirm message on the specified e-mail.'));
		}

		return $this->redirect(['index']);
	}

}
