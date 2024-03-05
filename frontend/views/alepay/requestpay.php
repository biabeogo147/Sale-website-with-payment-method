<?php

use common\models\SignatureHash;
use backend\models\TransactionInfo;


$getSignature = new SignatureHash();
$requestDataArray = $order->requestDataArray;
$requestData = $getSignature->getSignature($requestDataArray);

$url = "https://alepay-v3-sandbox.nganluong.vn/api/v3/checkout/request-payment";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
));

$resp = curl_exec($ch);
if ($e = curl_error($ch)) {
    echo $e;
} else {
    $decodeResp = json_decode($resp);

    $transactionCode = new TransactionInfo();
    $transactionCode->transaction_code = $decodeResp->transactionCode;
    $transactionCode->is_success = 0;
    $transactionCode->save();

    header("Location: " . $decodeResp->checkoutUrl);
    exit;
}

curl_close($ch);