<?php
/**
 * @var \common\models\Product $model 
 */
?>

<div class="card m-3 card-body p-1" style="text-align:center; width: 14.5rem;">
    <h5 class="card-title m-0">
        <?php echo $model->title ?>
    </h5>
    <p class="card-text m-0">
        <?php echo $model->visualProductPrice() ?>
    </p>
</div>