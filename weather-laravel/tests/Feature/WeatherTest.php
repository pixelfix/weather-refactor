<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_display_the_home_page()
    {
        $this
            ->get(route('home'))
            ->assertOk()
            ->assertSee('Welcome to Weather Wizard');
    }

    public function test_it_should_return_an_error_when_validation_fails(): void
    {
        $this
            ->post(route('home'))
            ->assertRedirect()
            ->assertSessionHas('errors');
    }

    public function test_it_should_fetch_the_weather_successfully(): void
    {
        $this
            ->post(route('home'), [
                'city' => 'London',
            ])
            ->assertOk()
            ->assertSee('Weather for London');
    }

}
