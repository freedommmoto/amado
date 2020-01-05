<?php

use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Products;

class OrderControllerTest extends TestCase
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
    public function testSendOrderWithNoProduct()
    {
        $data = ['firstName' => 'patara', 'product' => null, 'email' => 'm.c.kmitl@gmail.com'];
        $response = $this->json('POST', '/api/order/new', $data);

        $response->seeJson(
            ['success' => false]
        );

        $response->seeJsonStructure([
            'success',
            'error'
        ]);
    }

    public function testSendOrderWithAllData()
    {
        $data = ['firstName' => 'patara', 'product' => '[{"id_product":99,"name":"asd","price":250,"qty":1,"show":1}]', 'email' => 'm.c.kmitl@gmail.com'];
        $response = $this->json('POST', '/api/order/new', $data);

        $response->seeJson(
            ['success' => true]
        );

        $response->seeJsonStructure([
            'success'
        ]);
    }
}