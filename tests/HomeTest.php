<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    /**
     * A basic Homepage response and content test
     *
     * @return void
     */
    public function testHomeContent()
    {
        $this->get('/');

        $this->assertEquals(200, $this->response->status());

        $this->assertContains($this->app->version(), $this->response->getContent());
    }
}
