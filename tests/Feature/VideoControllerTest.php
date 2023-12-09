<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    public function testFetchVideos()
    {
        // Mock Guzzle HTTP Client
        $client = $this->getMockBuilder(Client::class)
                       ->setMethods(['get'])
                       ->getMock();

        $fakeHtmlResponse = '<html>...</html>';

        $client->method('get')
               ->willReturn(new Response(200, [], $fakeHtmlResponse));

        // Replace the real Guzzle HTTP Client with the mock
        app()->instance(Client::class, $client);

        // Make a request to the fetchVideos endpoint
        $response = $this->post('/fetch-videos', ['playlistUrl' => 'https://www.youtube.com/watch?v=YdzvO-SLh1A&list=PLKNUJAC-gEwJWsCktbN9odkx6VdLbqa9P']);

        // Assert that the request was successful (HTTP 200)
        $response->assertStatus(200);

        // Assert that the response contains the expected data
        $response->assertJson(['title' => 'Expected Video Title']);
        $response->assertJson(['url' => 'https://www.youtube.com/watch?v=YdzvO-SLh1A&list=PLKNUJAC-gEwJWsCktbN9odkx6VdLbqa9P']);
    }
}