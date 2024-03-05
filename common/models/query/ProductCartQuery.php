<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\ProductCart]].
 *
 * @see \app\models\ProductCart
 */
class ProductCartQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\ProductCart[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\ProductCart|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
