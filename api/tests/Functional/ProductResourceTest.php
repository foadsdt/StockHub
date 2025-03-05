<?php

namespace App\Tests\Functional;

use App\Factory\ProductFactory;
use App\Factory\UserFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Browser\Json;
use Zenstruck\Browser\Test\HasBrowser;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class ProductResourceTest extends KernelTestCase
{

    use HasBrowser;
    use ResetDatabase;
    use Factories;

    public function testGetCollectionOfProducts(): void
    {

//        ProductFactory::createMany(10);
//
//        $this->browser()
//            ->get('/api/products')
//            ->assertJson()
//            ->assertJsonMatches('"hydra:totalItems"', null)
//            ->json();

//        $this->browser()
//            ->post('/login');


    }

    public function testPatchToUpdateProduct()
    {
        $product = ProductFactory::new()->create();
        $user = UserFactory::createOne();
        $user->setRoles(['ROLE_PRODUCT_CREATOR']);

        $this->browser()
            ->actingAs($user)
            ->patch('/api/products/' . $product->getId(), [
                'json' => [
                    'value' => 123456
                ]
            ])
            ->assertStatus(200)
            ->assertJsonMatches('value', 123456);

    }

}
