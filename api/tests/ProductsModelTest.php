<?php

use App\Models\Products;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductsModelTest extends TestCase
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

    public function testReduceStockSuccessfully()
    {
        $request = new \Illuminate\Http\Request();
        $request->replace([
            'name' => 'test products',
            'stock' => 5,
            'price' => 123,
            'show' => 1
        ]);
        $id = Products::addNewProducts($request);

        $customerProuct = json_decode('[{"id_product":' . $id . ',"name":"photo-changsuek-250","price":250,"qty":2,"show":1}]', false);
        Products::reduceStock($customerProuct);

        $this->seeInDatabase('products', ['id_product' => $id, 'stock' => 3]);
    }

    public function testAddNewProductSuccessfully()
    {
        $request = new \Illuminate\Http\Request();
        $request->replace([
            'name' => 'test products',
            'stock' => 5,
            'price' => 123,
            'show' => 1
        ]);
        $id = Products::addNewProducts($request);

        $customerProuct = json_decode('[{"id_product":' . $id . ',"name":"photo-changsuek-250","price":250,"qty":2,"show":1}]', false);
        Products::reduceStock($customerProuct);

        $this->seeInDatabase('products', ['id_product' => $id, 'stock' => 3]);
    }

}