<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Order;

class AlepayController extends Controller
{
    public function actionRequestpay()
    {
        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            $request = Yii::$app->request->post("Order");
            $order->requestDataArray["amount"] = $request["amount"];
            $order->requestDataArray["orderDescription"] = $request["orderDescription"];
            $order->requestDataArray["buyerName"] = $request["buyerName"];
            $order->requestDataArray["buyerEmail"] = $request["buyerEmail"];
            $order->requestDataArray["buyerPhone"] = $request["buyerPhone"];
            $order->requestDataArray["buyerAddress"] = $request["buyerAddress"];
            $order->requestDataArray["buyerCity"] = $request["buyerCity"];
            $order->requestDataArray["buyerCountry"] = $request["buyerCountry"];
        }
        return $this->render('requestpay', ['order' => $order]);
    }
}