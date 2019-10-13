<?php

use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderModelTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @param $id
     * @param $expected
     */
    public function testCanSaveNewOrderSuccessfully()
    {
        $request = new \Illuminate\Http\Request();
        $request->replace([
            'firstName' => 'patara',
            'email' => 'm.c.kmitl@gmail.com',
            'product' => '[{"id":8,"name":"photo-changsuek-250","price":250,"img":"8.jpg","stock":1,"show":1}]',
        ]);

        $id = Order::addNewOrder($request);
        $this->seeInDatabase('order', ['order_id' => $id, 'email' => 'm.c.kmitl@gmail.com']);
    }

    /**
     * @param $id
     * @param $expected
     */
    public function testCanSaveNewOrderProductSuccessfully()
    {
        $products = json_decode('[{"id":8,"name":"photo-changsuek-250","price":250,"img":"8.jpg","stock":2,"show":1}]', false);
        OrderProduct::addNewOrderProduct($products, 99999);
        $this->seeInDatabase('order_product', ['order_id' => 99999]);
    }


}