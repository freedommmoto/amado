<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderProduct extends Model
{
    protected
        $table = 'order_product',
        $primaryKey = 'id_order_product';

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
            if (!$model->save()) {
                return false;
            }
        }

        return true;
    }

    final public static function getOrderReport(): array
    {
        $sql = "SELECT op.qty, 
                (op.qty * price) AS total,
                email,
                comment,
                op.created_at as date,
                p.name
            FROM order_product as op
            LEFT JOIN products as p on p.id_product = op.id_product
            LEFT JOIN \"order\" as o on o.id_order = op.id_order
            ORDER BY op.created_at DESC
        ";

        $results = DB::select($sql);
        if (is_array($results)) {
            return $results;
        }
        return [];
    }

}