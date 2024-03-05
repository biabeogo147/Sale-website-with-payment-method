<?php

/** @var \yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\assets\AppAsset;

AppAsset::register($this);
$this->registerCssFile("@frontend/web/css/site.css");
?>

<head>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group p {
            margin-bottom: 5px;
        }

        .btn-primary {
            background-color: #007BFF;
            border-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1 style="text-align:center;">Xác nhận đơn hàng</h1>

    <div class="d-flex justify-content-center" style="text-align:center;">
        <?php echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => 'productthanhtoan',
            'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}'
        ]);
        ?>
    </div>

    <div class="form-container">
        <?php $form = ActiveForm::begin([
            'action' => ['alepay/requestpay'],
            'method' => 'post',
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <div class="form-group">
            <p><strong>Total Amount:</strong>
                <span id="displayAmount">
                    <?= Html::encode($order->visualAmount()) ?>
                </span>
                <?= $form->field($order, 'amount')->hiddenInput(['value' => $order->amount, 'id' => 'amount'])->label(false); ?>
            </p>

            <?= $form->field($order, 'orderDescription')->textInput(['class' => 'form-control']) ?>
            <?= $form->field($order, 'buyerName')->textInput(['class' => 'form-control']) ?>
            <?= $form->field($order, 'buyerEmail')->textInput(['class' => 'form-control']) ?>
            <?= $form->field($order, 'buyerPhone')->textInput(['class' => 'form-control']) ?>
            <?= $form->field($order, 'buyerAddress')->textInput(['class' => 'form-control']) ?>
            <?= $form->field($order, 'buyerCity')->textInput(['class' => 'form-control']) ?>
            <?= $form->field($order, 'buyerCountry')->textInput(['class' => 'form-control']) ?>
            <?= Html::submitButton('Xác nhận thanh toán', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</body>

</html>