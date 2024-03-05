<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

$this->registerCssFile("@frontend/web/css/site.css");
$this->beginContent("@frontend/views/layouts/base.php");
?>

<main role="main" class="d-flex">
    <div class="shadow-sm">
        <?php echo $this->render('_sidebar') ?>
    </div>

    <div class="content-wrapper p-3 flex-grow-1">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?php $this->endContent() ?>