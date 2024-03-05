<?php

use common\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'DANH SÁCH SẢN PHẨM';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index" style="text-align:center;">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?= Html::a('Tạo sản phẩm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'product_image',
                'content' => function ($model) {
                        return $this->render('_product_item', ['model' => $model]);
                    },
                'contentOptions' => ['style' => 'width:15%;'],
            ],
            [
                'attribute' => 'status',
                'content' => function ($model) {
                        return $model->getStatusLabels()[$model->status];
                    }
            ],
            'title',
            'description:ntext',
            'tags',
            [
                'attribute' => 'product_price',
                'content' => function ($model) {
                        return $model->visualProductPrice();
                    }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'product_id' => $model->product_id]);
                    }
            ],
        ],
    ]); ?>


</div>