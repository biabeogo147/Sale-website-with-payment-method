<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\SignatureHash;
use backend\models\Transactioninfo;

class AlepayController extends Controller
{
    public function actionGettransactioninfo()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            "query" => Transactioninfo::find()->andWhere(['is_success' => 0]),
        ]);
        foreach ($dataProvider->getModels() as $model) {
            $model->requestDataArray["transactionCode"] = $model->transaction_code;
            $model->getTransactionCode();
        }
        return $this->render("gettransactioninfo");
    }
}