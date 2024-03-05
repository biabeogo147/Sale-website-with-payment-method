<?php ?>

<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

?>

<aside>
    <?php echo \yii\bootstrap5\Nav::widget([
        'options' => [
            'class' => 'd-flex flex-column nav-pills',
        ],
        'items' => [
            [
                'label' => 'Đơn hàng',
                'url' => ['/alepay/gettransactioninfo'],
            ],
            [
                'label' => 'Sản phẩm',
                'url' => ['/product/index'],
            ],
        ]
    ]) ?>
</aside>