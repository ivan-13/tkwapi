<?php

class EndpointTest extends TestCase
{

    public function testRestaurantEndpoint()
    {
        $response = $this->call('GET', '/v1/restaurant');

        $this->assertEquals(200, $response->status());
    }

    public function testRestaurantEndpointReturnsCorrectData()
    {
        $this->json('GET', '/v1/restaurant', ['id' => 98001237])
             ->seeJson([
                'name' => 'Classic Pizza',
                'branch'     => 'Rotterdam',
                'popularity' => 136
             ]);
    }

    public function testRestaurantEndpointReturnsAll()
    {
        $this->get('v1/restaurant', []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            '*' => [
                'id',
                'name',
                'branch',
                'phone',
                'email',
                'logo',
                'address',
                'housenumber',
                'postcode',
                'city',
                'latitude',
                'longitude',
                'url',
                'open',
                'bestMatch',
                'newestScore',
                'ratingAverage',
                'popularity',
                'averageProductPrice',
                'deliveryCosts',
                'minimumOrderAmount'
            ]
        ]);
    }
}