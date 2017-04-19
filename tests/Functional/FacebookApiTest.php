<?php

namespace Tests\Functional;

class FacebookApiTest extends BaseTestCase
{
    /**
     * testApiResultOK
     *
     * @return void
     */
    public function testApiResultOK()
    {
        $response = $this->runApp('GET', '/profile/facebook/12345');
        $data     = json_decode($response->getBody(), true);
        // check status code
        $this->assertEquals(200, $response->getStatusCode());
        // check keys
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('firstName', $data);
        $this->assertArrayHasKey('lastName', $data);
        // check values
        $this->assertEquals('12345', $data['id']);
        $this->assertEquals('Eli', $data['firstName']);
        $this->assertEquals('Richlin', $data['lastName']);
    }

    /**
     * testApiResultNotFound
     *
     * @return void
     */
    public function testApiResultNotFound()
    {
        $response = $this->runApp('GET', '/profile/facebook/0');
        $data     = json_decode($response->getBody(), true);
        // check status code
        $this->assertEquals(404, $response->getStatusCode());
        // check keys
        $this->assertArrayHasKey('code', $data);
        $this->assertArrayHasKey('message', $data);
        $this->assertEquals('404', $data['code']);
        $this->assertEquals('Facebook Profile Not Found', $data['message']);
    }
}
