<?php
namespace Tests\Settings;

class AdminTest extends \Tests\TestBase
{

  /**
   * List of tests
   * ================
   * [x] Admin Can list Settings
   * [x] Admin Can update Settings
   *
   */

  function before()
  {
      //runs before running ANY test method
      //clear the DB
    $this->resetDatabase();


    $data = [
      'Settings' => [
        [
          'name' => 'Settings1',
          'value' => 'Value1',
          'display_name' => 'Settings1',
          'description' => 'Description1'
        ],
        [
          'name' => 'Settings2',
          'value' => 'Value2',
          'display_name' => 'Settings2',
          'description' => 'Description2'
        ]
      ],
      'User' => [
        [
          'name' => 'testDealerAdmin',
          'username' => 'testDealerAdmin',
          'password' => 'password1',
          'role' => \Utils\Identity::CONTEXT_SUPER_ADMIN
        ]
       ],
       'Apikey' => [
        ['key' => 'adminkey', 'user' => '@User[0]', 'active' => 1]
       ]
    ];
    $this->fillData($data);
    $this->app->set('DEBUG', 5);
  }

  function testGetSettings()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
      'url' => 'GET /v1/settings'
    ]);

    $this->test->expect(
      $response['records'][0]['name'] == 'Settings1',
      "Return list of Settings"
    );
  }

  function testUpdateSettings()
  {
    $response = $this->mockRequest([
      'identity' => 'adminkey',
      'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded'
      ],
      'url' => 'PUT /v1/settings/',
      'data' => [
        [
          'id' => '1',
          'value' => 'UpdatedValue'
        ]
      ]
    ]);

    $this->test->expect(
      $response['records'][0]['value'] == 'UpdatedValue',
      "Admin can update Settings"
    );
  }

}