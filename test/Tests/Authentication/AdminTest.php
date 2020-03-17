<?php
namespace Tests\Authentication;

class AdminTest extends \Tests\TestBase{

    /**
     * List of tests
     * ================
     * [x] Valid login details successfully logs Admins in
     * [x] Valid login details successfully logs Users in
     * [x] Deleted user should not able to login
     *
     */

    function before(){

      //clear the DB
      $this->resetDatabase();

      $data = [
        'User' => [
          [
            'name' => 'testAdmin',
            'username' => 'testAdmin',
            'password' => 'password1',
            'role' => \Utils\Identity::CONTEXT_SUPER_ADMIN ,
            'deleted' => 0
          ],
          [
            'name' => "testAdmin2",
            'username' => "testAdmin2",
            'password' => "password1",
            'role' => \Utils\Identity::CONTEXT_SUPER_ADMIN ,
            'deleted' => 1,
          ],
          [
            'name' => "testuser",
            'username' => "testuser",
            'password' => "password1",
            'role' => \Utils\Identity::CONTEXT_SUPER_USER,
            'deleted' => 0,
          ],
          [
            'name' => "testUser2",
            'username' => "testUser2",
            'password' => "password1",
            'role' => \Utils\Identity::CONTEXT_SUPER_USER,
            'deleted' => 1,
          ]
        ]
      ];

      $this->fillData($data);

      $this->app->set('DEBUG', 0);
      $this->app->set('HIGHLIGHT', false);
    }

    function after(){

    }

    function testValidLoginAdmin(){
      $response = $this->mockRequest([
        'url'        => 'POST /v1/auth',
        'data' => [
          'username' => 'testAdmin',
          'password' => 'password1',
          'login_type' => \Utils\Identity::CONTEXT_SUPER_ADMIN
         ]
      ]);

      $this->test->expect(
        $response['records']['id'] == '1',
        "Valid auth request returns right admin"
      );

      $this->test->expect(
        !isset($response['records']['installer']),
        "Admin login does not return linked installer"
      );

      $this->test->expect(
        !isset($response['records']['franchisee']),
        "Admin login does not return linked franchisee"
      );
    }

    function testValidLoginUser(){
      $response = $this->mockRequest([
        'url'        => 'POST /v1/auth',
        'data' => [
          'username' => 'testuser',
          'password' => 'password1',
          'login_type' => \Utils\Identity::CONTEXT_SUPER_ADMIN
         ]
      ]);

      $this->test->expect(
        $response['records']['id'] == '3',
        "Valid auth request returns right user"
      );

      $this->test->expect(
        !isset($response['records']['installer']),
        "User login does not return linked installer"
      );

      $this->test->expect(
        !isset($response['records']['franchisee']),
        "User login does not return linked franchisee"
      );

    }

    function testLoginDeletedUser(){
      $response = $this->mockException([
        'url'        => 'POST /v1/auth',
        'data' => [
          'username' => 'testUser2',
          'password' => 'password1'
         ]
      ]);

      $this->test->expect(
        $this->contains($response, 'Invalid username'),
        "Deleted user should not able to login"
      );
    }

    function testLoginDeletedAdmin(){
      $response = $this->mockException([
        'url'        => 'POST /v1/auth',
        'data' => [
          'username' => 'testAdmin2',
          'password' => 'password1'
         ]
      ]);

      $this->test->expect(
          $this->contains($response, 'Invalid username'),
          "Deleted Admin should not able to login"
      );
    }


}