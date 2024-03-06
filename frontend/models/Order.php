<?php
namespace frontend\models;

use yii\base\Model;

class Order extends Model
{
    public $productName = "";
    public $productPrice = 0;
    public $quantity = 0;
    public $amount = 0;
    public $orderDescription = "none";
    public $buyerName = "none";
    public $buyerEmail = "none";
    public $buyerPhone = "none";
    public $buyerAddress = "none";
    public $buyerCity = "none";
    public $buyerCountry = "none";

    public $requestDataArray = array(
        "tokenKey" => "",
        "orderCode" => "random",
        "customMerchantId" => null,
        "amount" => 1000000,
        "currency" => "VND",
        "orderDescription" => "none",
        "totalItem" => 1,
        "installment" => false,
        "checkoutType" => 4,
        "month" => null,
        "bankCode" => null,
        "paymentMethod" => null,
        "returnUrl" => "https://alepay-v3-dev.nganluong.vn/demo/alepay/result.php",
        "cancelUrl" => "https://alepay-v3-dev.nganluong.vn/demo/alepay/",
        "buyerName" => "none@gmail.com",
        "buyerEmail" => "none@gmail.com",
        "buyerPhone" => "none",
        "buyerAddress" => "none",
        "buyerCity" => "none",
        "buyerCountry" => "none",
        "paymentHours" => 48,
        "promotionCode" => null,
        "merchantSideUserId" => null,
        "buyerPostalCode" => null,
        "buyerState" => null,
        "isCardLink" => false,
        "allowDomestic" => true
    );


    public function attributeLabels()
    {
        return [
            "amount" => "amount",
            "orderDescription" => "orderDescription",
            "buyerName" => "buyerName",
            "buyerEmail" => "buyerEmail",
            "buyerPhone" => "buyerPhone",
            "buyerAddress" => "buyerAddress",
            "buyerCity" => "buyerCity",
            "buyerCountry" => "buyerCountry",
        ];
    }

    public function visualAmount()
    {
        return number_format($this->amount, 0, ',', '.') . ' ₫';
    }
}
