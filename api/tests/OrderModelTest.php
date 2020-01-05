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
            'product' => '[{"id_product":8,"name":"photo-changsuek-250","price":250,"img":"8.jpg","stock":1,"show":1}]',
        ]);

        $id = Order::addNewOrder($request);
        $this->seeInDatabase('order', ['id_order' => $id, 'email' => 'm.c.kmitl@gmail.com']);
    }

    /**
     * @param $id
     * @param $expected
     */
    public function testCanSaveNewOrderProductSuccessfully()
    {
        $customerProducts = json_decode('[{"id_product":8,"name":"photo-changsuek-250","price":250,"img":"8.jpg","qty":2,"show":1}]', false);
        OrderProduct::addNewOrderProduct($customerProducts, 99999);
        $this->seeInDatabase('order_product', ['id_order' => 99999]);
    }

}