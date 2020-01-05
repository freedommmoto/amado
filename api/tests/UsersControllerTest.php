<?php

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\User;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $token;

    protected function setUp(): void
    {
        parent::setUp();

        $data = ['email' => 'tester@test.com', 'password' => 'authorization'];
        $user = new User();
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @param $expected
     */
    public function testLoginSuccessfully()
    {
        $data = ['email' => 'tester@test.com', 'password' => 'authorization'];
        $response = $this->json('POST', '/api/login', $data);
        $response->seeJsonStructure(['token']);

        $this->token = (json_decode($this->response->getContent(), true))['token'];

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];

        $response = $this->json('POST', '/api/user/profile', [], $headers);
        $response->seeJson(['success' => true]);
    }

    /**
     * @param $expected
     */
    public function testLoginWrongPassword()
    {
        $data = ['email' => 'tester@test.com', 'password' => 'authorizationtest'];
        $response = $this->json('POST', '/api/login', $data);
        $response->assertResponseStatus(401);
    }

}