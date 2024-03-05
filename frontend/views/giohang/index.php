<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'GIỎ HÀNG';
?>

<h1 style="text-align:center;">
    <?= Html::encode($this->title) ?>
</h1>

<?php echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'producttronggiohang',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}'
]);
?>

<h1 style="text-align:center;">
    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' => ['/giohang/payment'],
        'options' => ['enctype' => 'multipart/form-data'],
        'method' => 'post',
    ]); ?>

    <?= \yii\helpers\Html::submitButton('Thanh toán', ['class' => 'btn btn-primary']) ?>
    <?php \yii\widgets\ActiveForm::end(); ?>
</h1>