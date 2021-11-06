<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Client;
use App\Entity\Country;
use App\Entity\Item;
use App\Factory\ClientFactory;
use App\Factory\CountryFactory;
use App\Factory\InvoiceStatusFactory;
use App\Factory\ItemFactory;
use Faker\Factory;

class InvoicesTest extends ApiTestCase
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

    public function testGetInvoices(): void
    {
        $this->client->request('GET', '/api/invoices');
        $this->assertResponseIsSuccessful();
    }

    public function testPostValidInvoice(): void
    {
        $country = CountryFactory::createOne();
        $recipient = ClientFactory::createOne([
            'country' => $country
        ]);

        $items = ItemFactory::createMany(3);

        $statuses = InvoiceStatusFactory::createMany(2);

        $this->client->request('POST', '/api/invoices', [
            'body' => json_encode([
                'client' => "/api/clients/{$recipient->getId()}",
                'items' => $this->asItemsArray($items),
                'status' => "/api/invoice_statuses/{$statuses[0]->getId()}"
            ]),
        ]);
        $this->assertResponseIsSuccessful();
    }

    /**
     * helper function
     */
    private function asItemsArray(array $items): array
    {
        $data = [];
        foreach ($items as $item) {
            $data[] = "/api/items/{$item->getId()}";
        }
        return $data;
    }

}
