<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

// DependentFixtureInterface doit être défini dans une function, ici elle doit aller récup les données de category dans un tableau
class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Ane en carton');
        $product->setPrice('20.39');
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_TOYS));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Mousse à chapeau');
        $product->setPrice('20.39');
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_TOYS));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Ane electrique');
        $product->setPrice('39.99');
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_FUN));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Vole avec des ânes en anmérique');
        $product->setPrice('1299');
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_TRAVEL));
        $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}

