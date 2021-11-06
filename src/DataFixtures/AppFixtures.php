<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Country;
use App\Entity\InvoiceStatus;
use App\Entity\Item;
use App\Repository\CountryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Invoice States
        $states = [
            'Created',
            'Sent to Client',
            'Paid'
        ];
        foreach ($states as $label) {
            $status = new InvoiceStatus();
            $status->setLabel($label);
            $manager->persist($status);
        }

        // Countries
        $countries = [
            [
                'code' => 'DE',
                'name' => 'Germany',
                'vat' => 0.20
            ],
            [
                'code' => 'AU',
                'name' => 'Austria',
                'vat' => 0
            ],
            [
                'code' => 'EG',
                'name' => 'Egypt',
                'vat' => 0.10
            ],
            [
                'code' => 'PS',
                'name' => 'Palestine',
                'vat' => 0.17
            ],
        ];
        $_countries = [];
        foreach ($countries as $data) {
            $country = new Country();
            $country->setCode($data['code']);
            $country->setName($data['name']);
            $country->setVat($data['vat']);
            $manager->persist($country);
            $_countries[] = $country;
        }

        // Items
        $items = [
            [
                'title' => 'Laptop',
                'description' => 'Good one',
                'price' => 1200
            ],
            [
                'title' => 'Toy',
                'description' => 'Action figure',
                'price' => 120
            ],
            [
                'title' => 'Pizza',
                'description' => 'Best Taste',
                'price' => 40
            ],
        ];

        foreach ($items as $data) {
            $item = new Item();
            $item->setTitle($data['title']);
            $item->setDescription($data['description']);
            $item->setPrice($data['price']);
            $manager->persist($item);
        }

        // Clients
        $clients = [
            [
                'name' => 'Markus',
                'country' => $_countries[0]
            ],
            [
                'name' => 'Ahmed',
                'country' => $_countries[1]
            ]
        ];
        foreach ($clients as $data) {
            $client = new Client();
            $client->setName($data['name']);
            $client->setCountry($data['country']);
            $manager->persist($client);
        }
        $manager->flush();
    }
}
