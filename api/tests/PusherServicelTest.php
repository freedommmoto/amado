<?php

use  App\Service\PusherNotification;

class PusherServicelTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testSendUpdateNotificationToUI()
    {
        $pusher = new PusherNotification();
        $send = $pusher->sendUpdateNotificationToUI();
        $this->assertEquals(true, $send);
    }

}