<?php

namespace App\DataFixtures;

use App\Entity\Annonce;

use App\Entity\Categorie;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AnnonceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {$faker=Factory::create('fr_FR');
    //generer 100 annonces
        for($i=0;$i<100;$i++){
          $annonce=new Annonce();
          $annonce
              ->setTitre($faker->sentence(mt_rand(3,7),true))
              ->setDescription($faker->text(2000))
              ->setPrix($faker->numberBetween($min = 10, $max = 50))
              ->setVille($faker->city)
              ->setAdresse($faker->address)
              ->setCodePostal($faker->postcode)
              ->setCreation($faker->dateTimeAD($max = 'now', $timezone = null))
//              ->setCategorie('categorie_' . $i)
//              ->setAuteur()
            ;
            //Recuperation aléatoire d'une catégorie par une réference (on la fait apres avoir creer le category fixtures
            $categorieReference ='categorie_' .$faker->numberBetween(0,2);
            $categorie =$this->getReference($categorieReference);
            /** @var Categorie $categorie *///il est pas obligatoir (03/07/2020 10h20)7min
            //$category c'est un objet de la class category

            $annonce->setCategorie($categorie);

            //Recuperation aléatoire d'une catégorie par une réference (on la fait apres avoir creer le user fixtures
            $userReference ='user_' .$faker->numberBetween(0,40);
            $user =$this->getReference($userReference);
            /** @var User $user *///il est pas obligatoir (03/07/2020 10h20)7min


            $annonce->setAuteur($user);

//refernece de annonce
            $reference='annonce_' . $i;
            $this->addReference($reference, $annonce);


            $manager->persist($annonce);
        }


        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            CategorieFixtures::class,


        );
    }
}
