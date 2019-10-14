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
        $model->last_name = $request->input('lastName');
        $model->address = $request->input('streetAddress');
        $model->zip_code = $request->input('zipCode');
        $model->phone = $request->input('phoneNumber');
        $model->comment = $request->input('comment');
        $model->save();

        return $model->id_order;
    }
}