<?php
/**
 * @var \common\models\Product $model 
 */
?>

<div class="card m-3" style="width: 14.5rem;">
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
    </div>
</div>