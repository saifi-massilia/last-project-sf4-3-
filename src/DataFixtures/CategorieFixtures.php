<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //instanciation de faker
        $faker = Factory::create('fr_FR');


        //Creation de 3 catégories de produits:
        for ($i=0;$i<3;$i++){
            $categorie = new Categorie();
            $categorie->setNom($faker->realText(15));


            $manager->persist($categorie);


            //Définir une réference sur l'entité , pour la recuperer  dans d'autres fixtures
            $reference='categorie_' . $i;
            $this->addReference($reference, $categorie);

        }

        $manager->flush();
    }
}

