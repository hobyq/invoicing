<?php

namespace App\Factory;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Item>
 *
 * @method static Item|Proxy createOne(array $attributes = [])
 * @method static Item[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Item|Proxy find(object|array|mixed $criteria)
 * @method static Item|Proxy findOrCreate(array $attributes)
 * @method static Item|Proxy first(string $sortedField = 'id')
 * @method static Item|Proxy last(string $sortedField = 'id')
 * @method static Item|Proxy random(array $attributes = [])
 * @method static Item|Proxy randomOrCreate(array $attributes = [])
 * @method static Item[]|Proxy[] all()
 * @method static Item[]|Proxy[] findBy(array $attributes)
 * @method static Item[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Item[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ItemRepository|RepositoryProxy repository()
 * @method Item|Proxy create(array|callable $attributes = [])
 */
final class ItemFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'title' => self::faker()->sentence(2),
            'price' => self::faker()->numberBetween(1, 1000),
            'description' => self::faker()->sentence(5),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(Item $item) {})
            ;
    }

    protected static function getClass(): string
    {
        return Item::class;
    }
}
