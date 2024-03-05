<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'method' => 'post',
    ]); ?>

    <div class="row">
        <div class="col-sm-8">

            <?php echo $form->errorSummary($model) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <label>
                    <?php echo $model->getAttributeLabel('product_image') ?>
                </label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="product_image" name="product_image">
                </div>
            </div>

            <?= $form->field($model, 'product_price')->textInput() ?>

            <?= $form->field($model, 'created_by')->textInput(['value' => Yii::$app->user->identity->username, 'readonly' => true])->label(true); ?>

        </div>
        <div class="col-sm-4">
            <div class="mb-3" style="text-align:center;">
                <?= yii\helpers\Html::img($model->getProductImageLink(), ['style' => 'width:80%; height:auto;']) ?>
            </div>

            <div class="mb-3">
                <div class="text-muted">Product Name</div>
                <?php echo $model->title ?>
            </div>

            <?= $form->field($model, 'status')->dropDownList($model->getStatusLabels()) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>