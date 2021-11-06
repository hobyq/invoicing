<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\CountryFactory;
use Faker\Factory;

class ClientsTest extends ApiTestCase
{
    private $client;
    private $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient([], [
            'headers' => [
                'content-type' => 'application/json',
                'accept' => 'application/json'
            ]
        ]);
        $this->faker = Factory::create();
    }

    public function testGetClients(): void
    {
        $this->client->request('GET', '/api/clients');
        $this->assertResponseIsSuccessful();
    }

    public function testPostValidClient(): void
    {
        $country = CountryFactory::createOne([
            'code' => $this->faker->countryCode(),
            'name' => $this->faker->country()
        ]);

        $this->client->request('POST', '/api/clients', [
            'body' => json_encode([
                'name' => $this->faker->name(),
                'country' => "/api/countries/{$country->getId()}"
            ]),
        ]);
        $this->assertResponseIsSuccessful();
    }

    public function testPostCountryWithMissingDetails(): void
    {
        $this->client->request('POST', '/api/clients', [
            'body' => json_encode([
                'name' => $this->faker->name(),
            ]),
        ]);
        $this->assertResponseStatusCodeSame(422);
    }
}
