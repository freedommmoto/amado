<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    protected $table = 'users';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT = 'deleted';

    protected $dateFormat = 'Y-m-d H:i:sP';
    public $timestamps = false;

    /**
     * @param string $userName
     * @param string $token
     * @return bool
     */
    final public static function checkToken(string $token): bool
    {
        $tokenDecrypt = Crypt::decryptString($token);
        $tokenArray = explode(',', $tokenDecrypt);

        if (empty($tokenArray[1])) {
            return false;
        }

        $tokenExpired = date('Y-m-d H:i:s', strtotime($tokenArray[1] . '+1 day'));
        $now = date('Y-m-d H:i:s');

        if ($tokenExpired < $now) {
            return false;
        }

        return true;
    }

    /**
     * @param string $userName
     * @param string $password
     * @return array
     */
    final public static function processLogin(string $userName, string $password): array
    {
        $user = self::where('user_name', $userName)->first();
        if (empty($user)) {
            return [];
        }

        if (Hash::check($password, $user->pass_word)) {
            $token = Crypt::encryptString($userName . ',' . date('Y-m-d H:i:s'));
            if ($user->save()) {
                return ['userName' => $userName, 'token' => $token];
            }
        }

        return [];
    }


}