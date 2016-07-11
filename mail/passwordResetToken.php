<?php
use yii\helpers\Html;
 
/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
 
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/reset-password', 'token' => $user->password_reset_token]);
?>
 
<p>Здравствуйте, <?= Html::encode($user->username) ?>!</p>
 
<p>Пройдите по ссылке, чтобы сменить пароль: 
 
<?= Html::a(Html::encode($resetLink), $resetLink) ?></p>