<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\widgets\Alert;

AppAsset::register($this);

/** @var \yii\web\Controller $controller */
$controller =$this->context;

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title)?: Yii::$app->name ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody();

$menuItems = [ ['label' => Yii::t('app','Tasks'), 'url' => ['/task/index'] ] ];

if(!Yii::$app->user->isGuest) {
    /** @var \app\models\User $user */
    $user = Yii::$app->user->identity;
    $uName = @$user->name ?: $user->username;
    $isPerformer = (bool) \app\models\Performer::findOne($user->id);
    if($isPerformer){
        $menuItems += [
            ['label' => 'TaskType', 'url' => ['/task-type/index']],
            ['label' => 'User', 'url' => ['/user/index']],
            ['label' => 'Department', 'url' => ['/department/index']],
            ['label' => 'Performer', 'url' => ['/performer/index']],
            ['label' => 'Action', 'url' => ['/action/index']],
        ];
    }
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            Yii::t('app','Logout'),
            ['class' => 'btn btn-link']
        ).' ( '.Html::a($uName,['user/update','id' => $user->id]).' )'
        . Html::endForm()
        . '</li>';
}
else{
    $menuItems[] = ['label' => Yii::t('app','Signup'), 'url' => ['/site/signup']];
    $menuItems[] = ['label' => Yii::t('app','Login'), 'url' => ['/site/login']];
}
?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Html::a(Yii::t('app','Contact'), ['site/contact']) ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
