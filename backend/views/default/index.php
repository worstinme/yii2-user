<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


$this->title = Yii::t('user', 'Управление пользователями');
$this->params['breadcrumbs'][] = Yii::t('user', 'Управление пользователями');
?>
<div class="uk-grid">
	<div class="uk-width-medium-1-5">
		<?=$this->render('_nav')?>
	</div>
	<div class="uk-width-medium-4-5">
	<h1>Пользователи</h1>
	<hr>
	<?php
    $dataProvider = new ArrayDataProvider([
          'allModels' => Yii::$app->user->identity->find()->all(),
          'sort' => [
              'attributes' => ['username'],
          ],
          'pagination' => [
              'pageSize' => 10,
          ],
     ]);
    ?>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>false,
        'tableOptions'=>[
            'class'=>'uk-table uk-table-condensed uk-table-striped uk-table-hover',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
	        'username',
	        'email:email',

	        [
	        	'class' => 'yii\grid\ActionColumn',
	        	'contentOptions'=>['class'=>'uk-text-right'],
	        	'template' => '{permit}',
	        	'buttons' =>
	            	['permit' => function ($url, $model) {
	                    return Html::a('<i class="uk-icon-lock"></i>', Url::to(['/'.Yii::$app->controller->module->id.'/default/view', 'id' => $model->id]), [
	                         'title' => Yii::t('yii', 'Сменить роль пользователя'),'class'=>'uk-button uk-button-danger uk-button-mini'
	                    ]); },]
	        ],
        ],
    ]); ?>

	</div> 
</div>