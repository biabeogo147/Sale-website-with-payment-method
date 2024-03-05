<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\models\SignatureHash;

/**
 * This is the model class for table "{{%transaction_info}}".
 * @property int $id
 * @property int $is_success
 * @property string $transaction_code
 */
class TransactionInfo extends \yii\db\ActiveRecord
{
    /**
     * @var 
     */
    public $requestDataArray = [
        "tokenKey" => "GNW5huNJBxvha4WgmdJa0pxkQgQWMc",
        "transactionCode" => "",
    ];

    public $decodeResp;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%transaction_info}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_success', 'transaction_code'], 'required'],
            [['is_success'], 'integer'],
            [['transaction_code'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_success' => 'Is Success',
            'transaction_code' => 'Transaction Code',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TransactionInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransactionInfoQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $this->is_success = (isset($this->decodeResp->code) && $this->decodeResp->code == '000') ? 1 : 0;
        $saved = parent::save($runValidation, $attributeNames);

        $purchareJson = Yii::getAlias('@backend/web/storage/order/' . $this->transaction_code . '.json');
        if (!is_dir(dirname($purchareJson))) {
            FileHelper::createDirectory(dirname($purchareJson));
        }
        file_put_contents($purchareJson, json_encode($this->decodeResp, JSON_PRETTY_PRINT));

        return $saved;
    }

    public function getTransactionCode()
    {
        $getSignature = new SignatureHash();
        $requestData = $getSignature->getSignature($this->requestDataArray);

        $url = "https://alepay-v3-sandbox.nganluong.vn/api/v3/checkout/get-transaction-info";
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
            $this->decodeResp = json_decode($resp);
            $this->save();
        }
        curl_close($ch);
    }
}
