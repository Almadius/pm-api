<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Fixture;

use App\Shared\Definition\BaseFixture;
use Doctrine\Persistence\ObjectManager;

final class UserAdminFixture extends BaseFixture
{

    public function load(ObjectManager $manager)
    {
//        // create 20 products! Bam!
//        for ($i = 0; $i < 20; $i++) {
//            $product = new Product();
//            $product->setName('product '.$i);
//            $product->setPrice(mt_rand(10, 100));
//            $manager->persist($product);
//        }
//
//        $manager->flush();
    }
}