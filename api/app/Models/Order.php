<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{
    protected
        $table = 'order',
        $primaryKey = 'id_order';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT = 'deleted';

    protected $dateFormat = 'Y-m-d H:i:sP';

    final public static function addNewOrder(Request $request): int
    {
        $model = new self();
        $model->email = $request->input('email');
        $model->first_name = $request->input('firstName');
        $model->save();

        return $model->id_order;
    }
}