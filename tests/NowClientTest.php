<?php

class NowClientTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    public function it_should_make_request_with_client()
    {
        $apiKey = 'test_key';

        $client = Mockery::mock('Joecohens\Now\HttpClient\ClientInterface');
        $client->shouldReceive('getClient')->with($apiKey)->andReturnSelf();

        $now = new \Joecohens\Now\Now($apiKey, $client);

        $client->shouldReceive('get')->once()->with('deployments')->andReturn(
            ['deployments' => [['key' => 'value']]]
        );

        $this->assertInstanceOf('Joecohens\Now\Resources\Deployment', $now->deployments()[0]);
    }
}
