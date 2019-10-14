<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected
        $table = 'order_product',
        $primaryKey = 'id_order_product';

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
            $model->id_product = $product->id_product;
            $model->qty = $product->qty;
            $model->id_order = $orderID;
            if(!$model->save()){
                return false;
            }
        }

        return true;
    }
}