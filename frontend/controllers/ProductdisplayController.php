<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Order;
use common\models\Product;

class ProductdisplayController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            "query" => Product::find()->andWhere(['status' => Product::STATUS_PUBLISHED]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPayment($product_id)
    {
        $this->layout = 'blank';

        $model = Product::findOne($product_id);

        $order = new Order();
        $order->productName = $model->title;
        $order->productPrice = $model->product_price;

        return $this->render('payment', ['order' => $order]);
    }
}