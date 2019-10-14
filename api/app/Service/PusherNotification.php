<?php

namespace App\Service;

use Pusher\Pusher;

class PusherNotification
{
    public function __construct()
    {
        $this->pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            ['cluster' => env('PUSHER_CLUSTER'), 'useTLS' => true]
        );
    }

    /**
     * @return bool
     */
    public function sendUpdateNotificationToUI(): bool
    {
        try {
            $this->pusher->trigger('update-product-channel', 'update-product-event', ['message' => 'update']);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

}
