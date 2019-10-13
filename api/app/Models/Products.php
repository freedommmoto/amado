<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;


class Products extends Model
{
    protected
        $table = 'products',
        $primaryKey = 'id_product';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT = 'deleted';

    protected $dateFormat = 'Y-m-d H:i:sP';
    public $timestamps = false;

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
        $model->show = $request->input('show');
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
            $model = self::where('id_product', $customerProduct->id)->first();
            $model->stock = (int)$model->stock - (int)$customerProduct->stock;

            if ($model->stock < 1) {
                return false;
            }
            $model->save(['timestamps' => false]);
        }

        return true;
    }

}