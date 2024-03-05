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
    <div class="form-container">
        <?php $form = ActiveForm::begin([
            'action' => ['giohang/index'],
            'data-method' => 'post',
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <div class="form-group">
            <div class="" style="text-align:center;">
                <?= yii\helpers\Html::img($product->getProductImageLink(), ['style' => 'width:40%; height:auto;']) ?>
            </div>
            <p><strong>Product Name:</strong>
                <?= Html::encode($product->title) ?>
            </p>
            <p><strong>Product Price:</strong>
                <?= Html::encode($product->visualProductPrice()) ?>
            </p>
            <?= $form->field($order, 'quantity')->textInput(['class' => 'form-control', 'id' => 'quantity']) ?>
            <?= Html::submitButton('Thêm vào giỏ hàng', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</body>

</html>