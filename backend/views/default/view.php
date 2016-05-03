<?php
namespace developeruz\db_rbac\views\user;

use Yii;
use yii\helpers\Html;
use worstinme\uikit\ActiveForm;


$this->title = Yii::t('user', 'Управление ролями пользователя: ').$user->getUserName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="uk-grid row">

	<div class="uk-width-1-5 col-md-3">
		<?=$this->render('_nav')?>
	</div>

	<div class="uk-width-4-5 col-md-9">

	<h1><?=Yii::t('user', 'Управление ролями пользователя');?> <?= $user->getUserName(); ?></h1>

	<hr>
	
	<?php $form = ActiveForm::begin(['action' => ["update", 'id' => $user->getId()]]); ?>

	<div class="uk-form-row form-group">
	<?= Html::checkboxList('roles', $user_permit, $roles, ['separator' => '<br>']); ?>
	</div>

	<div class="uk-form-row form-group">
	    <?= Html::submitButton(Yii::t('user', 'Сохранить'), ['class' => 'uk-button uk-button-large uk-button-success btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>