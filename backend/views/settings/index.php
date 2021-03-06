<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$title = Yii::t('user', 'Settings');

$this->title = $title . ' | ' . Yii::$app->name;

$this->params['breadcrumbs'] = [
    $title,
];

?>
<h1><?= Html::encode($title) ?></h1>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableClientValidation' => false,
]); ?>

    <?= $form->field($model, 'email')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'firstName') ?>
    
    <?= $form->field($model, 'lastName') ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <?= Html::a(Yii::t('user', 'Change password'), ['password/index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
