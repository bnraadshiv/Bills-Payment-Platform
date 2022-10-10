<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_404_response()
    {
        $response = $this->get('/non-existent-route');

        $response->assertStatus(404);
    }

    public function test_number_equals_value()
    {
        $number = 1 + 4;

        $this->assertEquals(5, $number);
    }

    public function test_validate_json_structure()
    {
        $userInstance = [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@yahoo.com'
        ];

        $this->assertArrayHasKey('id', $userInstance);
        $this->assertArrayHasKey('name', $userInstance);
        $this->assertArrayHasKey('email', $userInstance);
    }

    public function test_data_type()
    {
        $number = 1;
        
        $string = 'string';

        $array = ['one', 'two', 'three'];

        $this->assertIsInt($number);

        $this->assertIsString($string);

        $this->assertIsArray($array);
    }


    public function test_json_path_of_data()
    {
        $fruits =  ['apple', 'banana', 'orange'];
        
        $this->assertContains('apple', $fruits);
    }
}
