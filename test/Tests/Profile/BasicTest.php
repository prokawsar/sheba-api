<?php
namespace Tests\Profile;

class BasicTest extends \Tests\TestBase
{

  /**
   * List of tests
   * ================
   * [x] Users can see Profiles
   * [x] Users cant see diffrent user's profile
   * [x] Users cant add new profile informations
   * [x] Users can update profile informations
   * [x] Users cant update role
   * [x] Users cant delete profile
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
          'name' => 'testAdmin',
          'username' => 'testAdmin',
          'password' => 'password1',
          'role' => \Utils\Identity::CONTEXT_SUPER_ADMIN
        ],
        [
          'name' => 'testUser',
          'username' => 'testUser',
          'password' => 'password1',
          'role' => \Utils\Identity::CONTEXT_SUPER_USER
        ]
      ],
      'Apikey' => [
        ['key' => 'adminkey', 'user' => '@User[0]', 'active' => 1],
        ['key' => 'userkey', 'user' => '@User[1]', 'active' => 1],
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

  function testGetProfile()
  {

    $keys = [
      'adminkey' => ['Admin', \Utils\Identity::CONTEXT_SUPER_ADMIN ],
      'userkey' => ['User', \Utils\Identity::CONTEXT_SUPER_USER],
    ];

    foreach ($keys as $k => $v) {

      $response = $this->mockRequest([
        'identity' => $k,
        'url' => 'GET /v1/profile'
      ]);

      $this->test->expect(
        $response['records']['role'] == $v[1],
        "Returns logged in " . $v[0] . "'s profile details."
      );
    }

  }

  function testGetSpecificUserProfile()
  {
    $keys = [
      'adminkey' => 'Admin',
      'userkey' => 'User',
      'dealeradminkey' => ' Dealer Admin',
      'dealeruserkey' => ' Dealer User',
      'installerkey' => ' Installer'
    ];

    foreach ($keys as $k => $v) {
      $response = $this->mockException([
        'identity' => $k,
        'url' => 'GET /v1/profile/3'
      ]);

      $this->test->expect(
        $this->contains($response, 'Not Found.'),
        $v . " cannot see specific user's profile information\n"
      );
    }
  }

  function testAddNewProfileInformation()
  {

    $keys = [
      'adminkey' => 'Admin',
      'userkey' => 'User',
    ];

    foreach ($keys as $k => $v) {
      $response = $this->mockException([
        'identity' => $k,
        'url' => 'POST /v1/profile',
        'data' => [
          'name' => 'AdminAdded',
          'username' => 'AdminAdded1'
        ]
      ]);

      $this->test->expect(
        $this->contains($response, 'Not Found.'),
        $v . " cannot add new profile information\n"
      );
    }
  }



  function testUpdateProfile()
  {
    $keys = [
      'adminkey' => ['Admin', 'AdminUpdated'],
      'userkey' => ['User', 'UserUpdated'],
    ];

    foreach ($keys as $k => $v) {

      $response = $this->mockRequest([
        'identity' => $k,
        'headers' => [
          'Content-Type' => 'application/x-www-form-urlencoded'
        ],
        'url' => 'PUT /v1/profile/',
        'data' => [
          'name' => $v[1],
          'username' => $v[1] . '_xxx'
        ]
      ]);

      $this->test->expect(
        ($response['records']['name'] == $v[1] && $response['records']['username'] == $v[1] . '_xxx'),
        $v[0] . " can update profile information"
      );
    }
  }

  function testEmptyMandatoryFields()
  {
    $keys = [
      'adminkey' => 'Admin',
      'userkey' => 'User',
    ];

    foreach ($keys as $k => $v) {
      $response = $this->mockException([
        'identity' => $k,
        'url' => 'PUT /v1/profile/',
        'data' => [
          'username' => ''
        ]
      ]);

      $this->test->expect(
        $this->contains($response, 'Bad Request.'),
        $v . " cannot set empty username\n"
      );
    }

    foreach ($keys as $k => $v) {
      $response = $this->mockException([
        'identity' => $k,
        'url' => 'PUT /v1/profile/',
        'data' => [
          'name' => ''
        ]
      ]);

      $this->test->expect(
        $this->contains($response, 'Bad Request.'),
        $v . " cannot set empty name\n"
      );
    }

    foreach ($keys as $k => $v) {
      $response = $this->mockException([
        'identity' => $k,
        'url' => 'PUT /v1/profile/',
        'data' => [
          'password' => ''
        ]
      ]);

      $this->test->expect(
        $this->contains($response, 'Please enter a password.'),
        $v . " cannot set empty password\n"
      );
    }
  }

  function testUpdateRole()
  {

    $keys = [
      'adminkey' => ['Admin', 'SA' , 'SU'],
      'userkey' => ['User', 'SU' , 'SA'],
    ];

    foreach ($keys as $k => $v) {

      $response = $this->mockRequest([
        'identity' => $k,
        'headers' => [
          'Content-Type' => 'application/x-www-form-urlencoded'
        ],
        'url' => 'PUT /v1/profile/',
        'data' => [
          'role' => $v[2]
        ]
      ]);

      $this->test->expect(
        $response['records']['role'] == $v[1],
        $v[0] . " cannot update Role"
      );
    }
  }


  function testDeleteProfile()
  {

    $keys = [
      'adminkey' => 'Admin',
      'userkey' => 'User',
    ];

    foreach ($keys as $k => $v) {
      $response = $this->mockException([
        'identity' => $k,
        'url' => 'DELETE /v1/profile'
      ]);

      $this->test->expect(
        $this->contains($response, 'Not Found.'),
        $v . " cannot delete own profile\n"
      );
    }

    foreach ($keys as $k => $v) {
      $response = $this->mockException([
        'identity' => $k,
        'url' => 'DELETE /v1/profile/3'
      ]);

      $this->test->expect(
        $this->contains($response, 'Not Found.'),
        $v . " cannot delete profile of another user\n"
      );
    }

  }

}