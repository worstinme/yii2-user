<?php

use yii\helpers\Html;
use worstinme\uikit\Breadcrumbs;
use worstinme\uikit\Alert;
use app\assets\AppAsset;

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
<body class="uk-height-1-1">
<?php $this->beginBody() ?>
			<?= Alert::widget() ?>
			<?php echo $content; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();