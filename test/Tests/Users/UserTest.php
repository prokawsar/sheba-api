<?php
namespace Tests\Users;

class UserTest extends \Tests\TestBase
{

  /**
   * List of tests
   * ================
   * [x] User are allowed to list users
   * [x] User not allowed to get a specific user
   * [x] User cannot create User
   * [x] User cannot updateUser
   * [x] User cannot delete User
   *
   */

  function before()
  {
    //runs before running ANY test method
    $this->resetDatabase();

    $this->setColumnDefaultValue('user', 'deleted');

    $data = [
      'User' => [
        [
          'name' => 'testAdmin1',
          'username' => 'testAdmin1',
          'password' => 'password1',
          'role' => \Utils\Identity::CONTEXT_SUPER_ADMIN
        ],
        [
          'name' => 'testAdmin2',
          'username' => 'testAdmin2',
          'password' => 'password1',
          'role' => \Utils\Identity::CONTEXT_SUPER_ADMIN ,
          'deleted' => 1
        ],
        [
          'name' => 'testUser1',
          'username' => 'testUser1',
          'password' => 'password1',
          'role' => \Utils\Identity::CONTEXT_SUPER_USER
        ],
        [
          'name' => 'testUser2',
          'username' => 'testUser2',
          'password' => 'password1',
          'role' => \Utils\Identity::CONTEXT_SUPER_USER,
          'deleted' => 1
        ],
        [
          'name' => 'testUser3',
          'username' => 'testUser2',
          'password' => 'password1',
          'role' => \Utils\Identity::CONTEXT_SUPER_USER
        ],
        [
          'name' => 'testUser4',
          'username' => 'testUser4',
          'password' => 'password1',
          'role' => \Utils\Identity::CONTEXT_SUPER_USER
        ]
      ],
      'Apikey' => [
        ['key' => 'userkey', 'user' => '@User[2]', 'active' => 1]
      ]
    ];


    $this->fillData($data);

  }

  function after()
  {
        //runs after running ALL test methods
  }

  function beforeEach()
  {
        //runs before EACH test method
  }

  function afterEach()
  {
        //runs after EACH test method
  }

  function testGetUsersForUser()
  {
    $response = $this->mockRequest([
      'identity' => 'userkey',
      'url' => 'GET /v1/users'
    ]);

    $this->test->expect(
      $response['records'][0]['name'] == 'testAdmin1',
      "Return Admin in the list"
    );

    $this->test->expect(
      $response['records'][1]['role'] == \Utils\Identity::CONTEXT_SUPER_USER,
      "Return  User in the list"
    );

    $this->test->expect(
      count($response['records']) == 4,
      "Although we have 6 admins/users, 2 deleted, only undeleted admins/users was returned"
    );

    $this->test->expect(
      !isset($response['records'][0]['password']),
      "User data does not leak user passwords"
    );

  }


  function testGetSpecificUsersByUser()
  {
    $response = $this->mockException([
      'identity' => 'userkey',
      'url' => 'GET /v1/users/3'
    ]);

    $this->test->expect(
      $this->contains($response, 'Unauthorized'),
      "Context User not allowed to get specific users"
    );
  }

  function testCreateUsersByUser()
  {
    $response = $this->mockException([
      'identity' => 'userkey',
      'url' => 'POST /v1/users',
      'data' => [
        'name' => 'testUserCreated',
        'username' => 'testUserCreated',
        'password' => 'password1',
        'role' => 'U'
      ]
    ]);

    $this->test->expect(
      $this->contains($response, 'Unauthorized'),
      "User cannot create Users"
    );
  }


  function testUpdateUsersByUser()
  {
    $response = $this->mockException([
      'identity' => 'userkey',
      'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded'
      ],
      'url' => 'PUT /v1/users/5',
      'data' => [
        'name' => 'testUserUpdated',
        'username' => 'testUserUpdated',
        'password' => 'password2',
        'role' => 'U'
      ]
    ]);

    $this->test->expect(
      $this->contains($response, 'Unauthorized'),
      "User cannot update Users"
    );
  }

  function testDeleteUsersByUser()
  {
    $response = $this->mockException([
      'identity' => 'userkey',
      'url' => 'DELETE /v1/users/6'
    ]);

    $this->test->expect(
      $this->contains($response, 'Unauthorized'),
      "User cannot delete Users"
    );
  }

}