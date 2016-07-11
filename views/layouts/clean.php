<?php

use yii\helpers\Html;
use worstinme\uikit\Breadcrumbs;
use worstinme\uikit\Alert;
use worstinme\user\assets\AppAsset;

AppAsset::register($this);  

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" dir="ltr" class="uk-height-1-1 uk-notouch login-page">
<head>
<meta charset="<?= Yii::$app->charset ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
</head>
<body class="uk-container uk-container-center uk-flex uk-flex-middle  uk-flex-center" style="min-height:100vh">
<?php $this->beginBody() ?>
    <div class="uk-panel" style="min-width:300px">
    	<h1><?= Html::encode($this->title) ?></h1>
        <?= Alert::widget() ?>
		<?php echo $content; ?>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();