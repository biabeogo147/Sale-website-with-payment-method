<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = 'Tạo sản phẩm mới';
$this->registerCssFile("@backend/web/css/site.css");
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1 class="mb-3" style="text-align:center;">
        <?= Html::encode($this->title) ?>
    </h1>

    <div class="d-flex flex-column justify-content-center align-items-center">

        <div class="upload-icon">
            <i class="fa-solid fa-boxes-packing"></i>
        </div>
        <br>

        <p>Tải lên tệp chứa ảnh của sản phẩm
        </p>

        <?php \yii\bootstrap5\ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            'method' => 'POST',
        ]) ?>

        <div class="form-group" style="text-align:center;">
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="product_image" name="product_image">
            </div>
            <?= Html::submitButton('Tải ảnh lên', ['class' => 'btn btn-success']) ?>
        </div>

        <?php \yii\bootstrap5\ActiveForm::end() ?>

    </div>

</div>