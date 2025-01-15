<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Liste des sweat-shirts
        $products = [
            [
                'name' => 'Blackbelt',
                'price' => 29.90,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 2,
                'featured' => true,
            ],
            [
                'name' => 'BlueBelt',
                'price' => 29.90,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 2,
                'featured' => false,
            ],
            [
                'name' => 'Street',
                'price' => 34.50,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 2,
                'featured' => false,
            ],
            [
                'name' => 'Pokeball',
                'price' => 45.00,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 2,
                'featured' => true,
            ],
            [
                'name' => 'PinkLady',
                'price' => 29.90,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 2,
                'featured' => false,
            ],
            [
                'name' => 'Snow',
                'price' => 32.00,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 2,
                'featured' => false,
            ],
            [
                'name' => 'Greyback',
                'price' => 28.50,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 2,
                'featured' => false,
            ],
            [
                'name' => 'BlueCloud',
                'price' => 45.00,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 2,
                'featured' => false,
            ],
            [
                'name' => 'BornInUsa',
                'price' => 59.90,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 2,
                'featured' => true,
            ],
            [
                'name' => 'GreenSchool',
                'price' => 42.20,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 2,
                'featured' => false,
            ],
        ];

        // Création des entités Product
        foreach ($products as $data) {
            foreach ($data['sizes'] as $size) {
                $product = new Product();
                $product->setName($data['name'])
                        ->setPrice($data['price'])
                        ->setSize($size)
                        ->setStock($data['stock']) // 2 exemplaires par taille
                        ->setFeatured($data['featured']);
                $manager->persist($product);
            }
        }

        $manager->flush();
    }
}
