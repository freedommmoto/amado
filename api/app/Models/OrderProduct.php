<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected
        $table = 'order_product',
        $primaryKey = 'order_product_id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT = 'deleted';

    protected $dateFormat = 'Y-m-d H:i:sP';

    /**
     * @param array $products
     * @param int $orderID
     * @return bool
     */
    final public static function addNewOrderProduct(array $products, int $orderID): bool
    {
        foreach ($products as $product) {
            $model = new self();
            $model->product_id = $product->id;
            $model->qty = $product->stock;
            $model->order_id = $orderID;
            $model->save();
        }

        return true;
    }
}