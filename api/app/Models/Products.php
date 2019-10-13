<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected
        $table = 'products',
        $primaryKey = 'id_product';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT = 'deleted';

    protected $dateFormat = 'Y-m-d H:i:sP';

    final public static function getBooking($id)
    {

    }
}