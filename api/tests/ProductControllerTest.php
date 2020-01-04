<?php

use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;

class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $token = '';

    protected function setUp(): void
    {
        parent::setUp();

        //login get token
        $data = ['email' => 'patara@test.com', 'password' => '1150kfc'];
        $this->json('POST', '/api/login', $data);
        $this->token = (json_decode($this->response->getContent(), true))['token'];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testAddProductSuccess()
    {
        $data = ['name' => 'test product', 'price' => 100, 'quantity' => 12];
        $file = ['image' => UploadedFile::fake()->image('image.jpg')];

        $this->call('POST', '/api/product/add', $data, [], $file, ['Authorization' => 'Bearer ' . $this->token]);
        $this->assertResponseStatus(200);
        $this->assertEquals(true, (json_decode($this->response->getContent(), true))['success']);
    }

    public function testAddProductWithNoImage()
    {
        $data = ['name' => 'test product', 'price' => 100, 'quantity' => 12, 'image' => 'image.jpg'];

        $this->post('/api/product/add', $data, ['Authorization' => 'Bearer ' . $this->token]);
        $arrayRes = json_decode($this->response->getContent(), true);

        $this->assertEquals(false, $arrayRes['success']);
        $this->assertEquals('no product file', $arrayRes['error']);
    }

}