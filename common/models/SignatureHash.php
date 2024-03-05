<?php
namespace common\models;

use yii\base\Model;

class SignatureHash extends Model
{
    public function getSignature($requestDataArray)
    {
        ksort($requestDataArray);

        $hashString = "";
        $checkSumKey = "CzXoy4LBJfbeCMtHr2XRddfBnJEevA";
        foreach ($requestDataArray as $key => $value) {
            if (is_bool($value))
                $value = $value ? "true" : "false";
            elseif (is_array($value)) {
                $value = base64_encode(json_encode($value));
            }
            $hashString .= "&" . $key . "=" . $value;
        }
        $hashString = ltrim($hashString, '&');
        $signature = hash_hmac("sha256", $hashString, $checkSumKey);
        $requestDataArray['signature'] = $signature;
        return json_encode($requestDataArray);
    }
}