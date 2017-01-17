<?php

namespace cms\user\auth\map;

use yii\helpers\ArrayHelper;

class VKontakte extends Base
{

	public function getMap()
	{
		return [
			'id' => 'user_id',
			'firstName' => 'first_name',
			'lastName' => 'last_name',
			'pic' => 'photo_100',
		];
	}

}