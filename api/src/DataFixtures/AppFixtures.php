<?php

namespace App\DataFixtures;

use App\Factory\ApiTokenFactory;
use App\Factory\ProductFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        UserFactory::createMany(10);

        ProductFactory::createMany(10);
    }
}
