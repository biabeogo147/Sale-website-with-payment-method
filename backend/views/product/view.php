<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1 class="mb-3" style="text-align:center;">
        <?= Html::encode($this->title) ?>
    </h1>

    <div class="mb-3" style="text-align:center;">
        <?= yii\helpers\Html::img($model->getProductImageLink(), ['style' => 'width:30%; height:auto;']) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product_id',
            'title',
            'description:ntext',
            'tags',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                        return $model->getStatusLabels()[$model->status];
                    },
            ],
            'product_price',
            'created_by',
        ],
    ]) ?>

    <p class="mb-3" style="text-align:center;">
        <?= Html::a('Chỉnh sửa sản phẩm', ['update', 'product_id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa sản phẩm', ['delete', 'product_id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>