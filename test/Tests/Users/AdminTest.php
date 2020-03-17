<?php
namespace Tests\Users;

class AdminTest extends \Tests\TestBase
{

  /**
   * List of tests
   * ================
   * [x] Returns a list of Admin/Users
   * [x] User data does not leak user passwords
   * [x] Does not return deleted Admins/Users in the list
   * [x] Return specific admin/user
   * [x] Cannot view Admin/User that are deleted
   * [x] Admin can create Admin
   * [x] User cannot create User
   * [x] Admin can udate User
   * [x] User cannot updateUser
   * [x] Admin can delete User
   * [x] User cannot delete User
   * [x] Users searched by name was found.
   * [x] Users searched by username was found.
   * [x] Users searched by role was found.
   * [x] Users searched by role was return all Users with that role.
   * [x] Users searched by role wasn't return deleted users
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
          'surname' => 'sname4',
          'username' => 'testUser4',
          'password' => 'password1',
          'role' => \Utils\Identity::CONTEXT_SUPER_USER
        ]
      ],
      'Apikey' => [
        ['key' => 'adminkey', 'user' => '@User[0]', 'active' => 1]
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

  function testGetUsersForAdmin()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
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



  function testGetSpecificUsersByAdmin()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
      'url' => 'GET /v1/users/1'
    ]);

    $this->test->expect(
      $response['records']['name'] == 'testAdmin1',
      "Return specific Admin"
    );
  }

  function testGetDeletedUsers()
  {
    $response = $this->mockException([
      'identity' => 'adminkey',
      'url' => 'GET /v1/users/2'
    ]);

    $this->test->expect(
      $this->contains($response, 'Not Found'),
      "Deleted specific User should not be displayed."
    );
  }

  function testCreateUsersByAdmin()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
      'url' => 'POST /v1/users',
      'data' => [
        'name' => 'testAdminCreated',
        'username' => 'testAdminCreated',
        'password' => 'password1',
        'role' => 'SA'
      ]
    ]);

    $this->test->expect(
      $response['records']['name'] == 'testAdminCreated',
      "Admin can create Users"
    );
  }

  function testCreateUserWithExistingUsername()
  {
    $response = $this->mockException([
      'identity' => 'adminkey',
      'url' => 'POST /v1/users',
      'data' => [
        'name' => 'testAdminCreated',
        'username' => 'testUser1',
        'password' => 'password1',
        'role' => 'SA'
      ]
    ]);

    $this->test->expect(
      $this->contains($response, 'Username already exists'),
      "Creating Users With the Username is already exists in DB is Not Allowed"
    );
  }

  function testUpdateUsersByAdmin()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
      'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded'
      ],
      'url' => 'PUT /v1/users/5',
      'data' => [
        'name' => 'testAdminUpdated',
        'username' => 'testAdminUpdated',
        'password' => 'password2',
        'role' => 'SA'
      ]
    ]);

    $this->test->expect(
      $response['records']['name'] == 'testAdminUpdated',
      "Admin can Update User"
    );
  }

  function testUpdateUserWithExistingUsername()
  {
    $response = $this->mockException([
      'identity' => 'adminkey',
      'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded'
      ],
      'url' => 'PUT /v1/users/5',
      'data' => [
        'name' => 'testAdminCreated',
        'username' => 'testUser1',
        'password' => 'password1',
        'role' => 'SA'
      ]
    ]);

    $this->test->expect(
      $this->contains($response, 'Username already exists'),
      "Updating Users With the Username is already exists in DB is Not Allowed"
    );
  }


  function testDeleteUsersByAdmin()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
      'url' => 'DELETE /v1/users/5'
    ]);

    $this->test->expect(
      $response['records']['id'] == 5,
      "Admin can Delete User"
    );
  }


  function testSearchUsersByName()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
      'url' => 'GET /v1/users?q=name[lk]:testUser4'
    ]);

    $this->test->expect(
      $response['records'][0]['name'] == 'testUser4',
      "Users searched by name was found."
    );
  }

  function testSearchUsersBySurname()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
      'url' => 'GET /v1/users?q=surname[lk]:sname4'
    ]);

    $this->test->expect(
      $response['records'][0]['name'] == 'testUser4',
      "Users searched by name was found."
    );
  }

  function testSearchUsersByEmail()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
      'url' => 'GET /v1/users?q=username[lk]:testUser4'
    ]);

    $this->test->expect(
      $response['records'][0]['username'] == 'testUser4',
      "Users searched by username was found."
    );
  }

  function testSearchUsersByRole()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
      'url' => 'GET /v1/users?q=role[lk]:U'
    ]);

    $this->test->expect(
      $response['records'][0]['role'] == 'U',
      "Users searched by role was found."
    );

    $this->test->expect(
      count($response['records']) == 2,
      "Users searched by role was return all undeleted Users with that role."
    );

  }

}