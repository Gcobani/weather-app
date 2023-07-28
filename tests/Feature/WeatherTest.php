<?php

namespace Tests\Feature;

use App\Http\API\NeutrinoApiClient;
use App\Http\API\OpenWeatherMapClient;
use App\Http\Requests\WeatherRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     * A basic home page load test.
     *
     * @return void
     */
    public function testHomePageLoad(): void
    {
        $response = $this->get('/home');
        $response->assertStatus(200);
        $response->assertSee('Please Enter Address');
        $response->assertSee('View Weather');
        $response->assertDontSee('<div class="current-temperature">');
    }

    /**
     * Test response when posting a address
     *
     * @return void
     */
    public function testPostDataToController(): void
    {
        $openWeatherMapClientMock = Mockery::mock(OpenWeatherMapClient::class)->shouldReceive('getWeatherByAddress')
            ->once()
            ->andReturn([
                'weather' => ['main' => 'cloudy', 'description' => 'partly cloudy'],
                'wind' => ['speed' => 49.2, 'deg' => 90],
                'main' => ['temp' => 31, 'temp_min' => 29, 'temp_max'=> 33, 'humidity' => 64],
                'name' => 'Strand',
                'sys' => ['country' => 'ZA']
            ])->getMock();

        $neutrinoApiClientMock = Mockery::mock(NeutrinoApiClient::class)->shouldReceive('geoCodeAddress')
            ->once()
            ->andReturn([
                'locations' => [['city' => 'Strand, Cape Town', 'country-code' => 'ZA']]
            ])->getMock();
        app()->instance(NeutrinoApiClient::class, $neutrinoApiClientMock);
        app()->instance(OpenWeatherMapClient::class, $openWeatherMapClientMock);

        $response = $this->post('/home', ['address' => '14 main road, strand, cape town, south africa']);
        $response->assertStatus(200);
        $response->assertSee(strip_tags('<div class="current-temperature">'), true);
    }
}
