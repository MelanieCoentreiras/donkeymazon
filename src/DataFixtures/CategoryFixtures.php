<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_TOYS = 'CATEGORY_TOYS';
    public const CATEGORY_FUN = 'CATEGORY_FUN';
    public const CATEGORY_TRAVEL = 'CATEGORY_TRAVEL';
    public function load(ObjectManager $manager): void
    {
        $travels = new Category();
        $travels->setName('Voyages');
        $manager->persist($travels);
        $this->addReference(self::CATEGORY_TRAVEL, $travels);

        $fun = new Category();
        $fun->setName('Loisirs');
        $manager->persist($fun);
        $this->addReference(self::CATEGORY_FUN, $fun);

        $toys = new Category();
        $toys->setName('Jouets');
        $manager->persist($toys);
        $this->addReference(self::CATEGORY_TOYS, $toys);

        $manager->flush();
    }
}
