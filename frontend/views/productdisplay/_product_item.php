<?php
/**
 * @var \common\models\Product $model 
 */
?>

<div class="card m-3" style="width: 14.5rem;">
    <a href="<?php echo \yii\helpers\Url::to(['/productdisplay/payment', 'product_id' => $model->product_id]); ?>"
        style="text-decoration: none; color: inherit;">
        <div class="" style="text-align:center;">
            <?= yii\helpers\Html::img($model->getProductImageLink(), ['style' => 'width:80%; height:auto;']) ?>
        </div>

        <div class="card-body p-1" style="text-align:center;">
            <h5 class="card-title m-0">
                <?php echo $model->title ?>
            </h5>
            <p class="card-text m-0">
                <?php echo $model->visualProductPrice() ?>
            </p>

            <?php $form = \yii\widgets\ActiveForm::begin([
                'action' => ['/giohang/add', 'product_id' => $model->product_id],
                'options' => ['enctype' => 'multipart/form-data'],
                'method' => 'post',
            ]); ?>
            <?= \yii\helpers\Html::submitButton('Thêm vào giỏ hàng', ['class' => 'btn btn-primary']) ?>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </a>
</div>