<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class WeatherAPITest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_weather()
    {
        $response = $this->postJson('/weather', [
            'city'      => 'batangas',
            'country'   => 'PH'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'source',
                     'data'     => [
                         'main'     => ['temp', 'feels_like', 'humidity'],
                         'weather'  => [['description']],
                         'name',
                         'sys'      => ['country'],
                     ]
                 ]);
    }

    public function test_error_missin_city(){
        $response = $this->postJson('/weather', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['city']);
    }
}
