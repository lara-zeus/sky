<?php

namespace LaraZeus\Sky\Tests\Unit;

class ExampleTest extends \LaraZeus\Sky\Tests\TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function accsess_the_route()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/sky');
        $response->assertStatus(200);
    }
}