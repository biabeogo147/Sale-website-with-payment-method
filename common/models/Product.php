<?php

namespace common\models;

use Yii;
use Imagine\Filter\Basic\Thumbnail;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use Imagine\Image\Box;
use yii\imagine\Image;
use Imagine\Image\Point;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property string $product_id
 * @property string $title
 * @property string|null $description
 * @property string|null $tags
 * @property int|null $status
 * @property int|null $product_price
 * @property string|null $created_by
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_UNLISTED = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @var \yii\web\UploadedFile
     */
    public $product_image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['product_id', 'title'], 'required'],
            [['description'], 'string'],
            [['status', 'product_price'], 'integer'],
            [['product_id'], 'string', 'max' => 16],
            [['title', 'tags', 'created_by'], 'string', 'max' => 512],
            [['product_id'], 'unique'],
            ['product_price', 'default', 'value' => 0],
            ['status', 'default', 'value' => self::STATUS_UNLISTED],
            ['product_image', 'image', 'extensions' => [
                'gif',
                'jpg', 'jpeg', 'jfif', 'pjpeg', 'pjp',
                'png',
                'svg',
                'webp']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'title' => 'Title',
            'description' => 'Description',
            'tags' => 'Tags',
            'status' => 'Status',
            'product_price' => 'Product Price',
            'product_image' => 'Product Image',
            'created_by' => 'Created By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $isInsert = $this->isNewRecord;
        if ($isInsert) {
            $this->product_id = Yii::$app->security->generateRandomString(8);
            $this->title = pathinfo($this->product_image->name, PATHINFO_FILENAME);
        }
        $saved = parent::save($runValidation, $attributeNames);
        if (!$saved) {
            return false;
        }
        if ($this->product_image) {
            $productImagePath = Yii::getAlias('@frontend/web/storage/productimages/' . $this->product_id . '.jpg');
            if (!is_dir(dirname($productImagePath))) {
                FileHelper::createDirectory(dirname($productImagePath));
            }
            $this->product_image->saveAs($productImagePath);

            $image = Image::getImagine()->open($productImagePath);
            $size = $image->getSize();

            $cropSize = min($size->getWidth(), $size->getHeight());
            $startX = ($size->getWidth() - $cropSize) / 2;
            $startY = ($size->getHeight() - $cropSize) / 2;

            $image->crop(new Point($startX, $startY), new Box($cropSize, $cropSize))
                ->resize(new Box(640, 640))
                ->save();
        }
        return true;
    }

    public function getProductImageLink()
    {
        return Yii::$app->params['frontendUrl'] . 'storage/productimages/' . $this->product_id . '.jpg';
    }

    public function getStatusLabels()
    {
        return [
            self::STATUS_UNLISTED => 'Unlisted',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }

    public function visualProductPrice()
    {
        return number_format($this->product_price, 0, ',', '.') . ' ₫';
    }
}
