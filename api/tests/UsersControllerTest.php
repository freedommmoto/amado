<?php

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\User;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $data = ['userName' => 'tester', 'passWord' => 'Authorization'];
        $user = new User();
        $user->user_name = $data['userName'];
        $user->pass_word = Hash::make($data['passWord']);
        $user->save();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @param $expected
     */
//    public function testLoginSuccessfully()
//    {
//        $data = ['userName' => 'tester', 'passWord' => 'Authorization'];
//        $response = $this->json('POST', '/user/login', $data);
//        $response->seeJson(
//            ['success' => true]
//        );
//        $response->seeJsonStructure([
//            'success',
//            'userData'
//        ]);
//
//        $data = json_decode($this->response->getContent(), true);
//
//        $headers = [
//            'Accept' => 'application/json',
//            'Content-Type' => 'application/json',
//            'userName' => $data['userData']['userName'],
//            'token' => $data['userData']['token'],
//        ];
//
//        $response = $this->json('POST', '/user/auth', [], $headers);
//        $response->seeJson(
//            ['success' => true]
//        );
//    }
//
//    public function testCheckEnterWithoutToken()
//    {
//        $headers = [
//            'Accept' => 'application/json',
//            'Content-Type' => 'application/json',
//        ];
//
//        $response = $this->json('POST', '/user/auth', [], $headers);
//        $response->seeStatusCode(422);
//    }
//
//    public function testCheckEnterWithExpiredToken()
//    {
//        $data = ['userName' => 'tester', 'passWord' => 'Authorization'];
//        $token = Crypt::encryptString($data['userName'] . ',' . date('Y-m-d H:i:s', strtotime('-2 days')));
//        $headers = [
//            'Accept' => 'application/json',
//            'Content-Type' => 'application/json',
//            'userName' => $data['userName'],
//            'token' => $token
//        ];
//
//        $response = $this->json('POST', '/user/auth', [], $headers);
//        $response->seeStatusCode(422);
//    }
}