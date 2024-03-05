<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_cart}}".
 *
 * @property int $id
 * @property string $product_id
 * @property int $user_id
 * @property int|null $product_price
 * @property string $title
 *
 * @property Product $product
 * @property User $user
 */
class ProductCart extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $product_image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_cart}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'user_id', 'title'], 'required'],
            [['user_id', 'product_price'], 'integer'],
            [['product_id'], 'string', 'max' => 16],
            [['title'], 'string', 'max' => 512],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'product_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'product_price' => 'Product Price',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['product_id' => 'product_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductCartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductCartQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $saved = parent::save($runValidation, $attributeNames);
        return $saved;
    }

    public function getProductImageLink()
    {
        return Yii::$app->params['frontendUrl'] . 'storage/productimages/' . $this->product_id . '.jpg';
    }

    public function visualProductPrice()
    {
        return number_format($this->product_price, 0, ',', '.') . ' ₫';
    }
}
