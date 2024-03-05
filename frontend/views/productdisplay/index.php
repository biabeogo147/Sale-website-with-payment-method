<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'DANH SÁCH SẢN PHẨM';
?>

<h1 style="text-align:center;">
    <?= Html::encode($this->title) ?>
</h1>

<?php echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_product_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}'
]);
?>