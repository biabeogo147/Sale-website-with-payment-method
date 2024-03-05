<?php
use common\models\ProductCart;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html;

?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-lg navbar-light bg-light shadow-sm',
        ]
    ]);
    if (Yii::$app->user->isGuest == false) {
        $menuItems = [
            [
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post',],
            ],
            [
                'label' => 'Giỏ hàng (' . ProductCart::find()->count() . ')',
                'url' => ['/giohang/index'],
                'linkOptions' => ['data-method' => 'post',],
            ],
        ];
    } else {
        $menuItems = [
            ['label' => 'Signup', 'url' => ['/site/signup'],],
            ['label' => 'Login', 'url' => ['/site/login'],],
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</div>