<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Products extends Model
{
    protected
        $table = 'products',
        $primaryKey = 'id_product';

    protected $dateFormat = 'Y-m-d H:i:sP';
    public $timestamps = false;

    public static $returnable = ['name', 'stock', 'price', 'show'];

    /**
     * @param Request $request
     * @return int
     */
    final public static function addNewProducts(Request $request): int
    {
        $model = new self();
        $model->name = $request->input('name');
        $model->stock = $request->input('stock');
        $model->price = $request->input('price');
        $model->show = empty($request->input('show')) ? true : $request->input('show');
        $model->save();
        return $model->id_product;
    }

    /**
     * @param array $customerProducts
     * @return bool
     */
    final public static function reduceStock(array $customerProducts): bool
    {
        foreach ($customerProducts as $customerProduct) {
            $model = self::where('id_product', $customerProduct->id_product)->first();
            $model->stock = (int)$model->stock - (int)$customerProduct->qty;
            if ($model->stock < 0) {
                return false;
            }
            $model->save();
        }

        return true;
    }

    final public static function clearCached(): void
    {
        Redis::set('products', null);
    }

}