<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\CountryFactory;
use App\Factory\ItemFactory;
use Faker\Factory;

class ItemsTest extends ApiTestCase
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

    public function testGetItems(): void
    {
        $this->client->request('GET', '/api/items');
        $this->assertResponseIsSuccessful();
    }

    public function testPostValidItem(): void
    {
        $this->client->request('POST', '/api/items', [
            'body' => json_encode([
                'title' => $this->faker->sentence(2),
                'price' => $this->faker->numberBetween(1, 1000),
            ]),
        ]);
        $this->assertResponseIsSuccessful();
    }

    public function testPostCountryWithMissingDetails(): void
    {
        $this->client->request('POST', '/api/items', [
            'body' => json_encode([
                'title' => $this->faker->sentence(2),
            ]),
        ]);
        $this->assertResponseStatusCodeSame(422);
    }

    public function testPostCountryWithInvalidDetails(): void
    {
        $this->client->request('POST', '/api/items', [
            'body' => json_encode([
                'title' => $this->faker->sentence(2),
                'price' => $this->faker->word()
            ]),
        ]);
        $this->assertResponseStatusCodeSame(400);
    }
}
