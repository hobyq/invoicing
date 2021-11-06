<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class CountriesTest extends ApiTestCase
{
    private $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient([], [
            'headers' => [
                'content-type' => 'application/json',
                'accept' => 'application/json'
            ]
        ]);
    }

    public function testGetCountries(): void
    {
        $this->client->request('GET', '/api/countries');
        $this->assertResponseIsSuccessful();
    }

    public function testPostValidCountry(): void
    {
        $this->client->request('POST', '/api/countries', [
            'body' => json_encode([
                'name' => 'Germany',
                'code' => 'DE',
                'vat' => 0.19
            ]),
        ]);
        $this->assertResponseIsSuccessful();
    }

    public function testPostCountryWithMissingDetails(): void
    {
        $this->client->request('POST', '/api/countries', [
            'body' => json_encode([
                'name' => 'Germany',
                'code' => 'DE',
            ]),
        ]);
        $this->assertResponseStatusCodeSame(422);
    }

    public function testPostCountryWithInvalidDetails(): void
    {
        $this->client->request('POST', '/api/countries', [
            'body' => json_encode([
                'name' => 'Germany',
                'code' => 'DEE',
                'vat' => 'ten'
            ]),
        ]);
        $this->assertResponseStatusCodeSame(400);
    }
}
