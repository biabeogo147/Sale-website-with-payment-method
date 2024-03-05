<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use frontend\models\Order;
use common\models\ProductCart;
use common\models\Product;

class GiohangController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['add'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verb' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'add' => ['post'],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            "query" => ProductCart::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd($product_id)
    {
        $productInCart = new ProductCart();
        $product = Product::findOne($product_id);
        $productInCart->title = $product->title;
        $productInCart->user_id = Yii::$app->user->id;
        $productInCart->product_id = $product->product_id;
        $productInCart->product_image = $product->product_image;
        $productInCart->product_price = $product->product_price;
        $productInCart->save();
        return $this->redirect(["giohang/index", "product_id" => $product_id]);
    }

    public function actionPayment()
    {
        $this->layout = 'blank';
        $dataProvider = new \yii\data\ActiveDataProvider([
            "query" => ProductCart::find(),
        ]);

        $order = new Order();
        $order->amount = ProductCart::find()->sum('product_price');
        return $this->render('payment', ['order' => $order, 'dataProvider' => $dataProvider]);
    }
}