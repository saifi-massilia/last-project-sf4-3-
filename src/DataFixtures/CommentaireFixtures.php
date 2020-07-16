<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\Commentaire;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentaireFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create('fr_FR');
            //GENERER 20 COMMENTAIRES
            for ($i=0;$i<20;$i++){
                $com=new Commentaire();
                $com
                    ->setCommentaire($faker->text(1000))
                    ->setCreation($faker->dateTimeAD($max = 'now', $timezone = null))
                    ;
                //Recuperation aléatoire d'une catégorie par une réference (on la fait apres avoir creer le user fixtures
                $userReference ='user_' .$faker->numberBetween(0,60);
                $user =$this->getReference($userReference);
                /** @var User $user *///il est pas obligatoir (03/07/2020 10h20)7min


                $com->setAuteur($user);


                $annonceReference ='annonce_' .$faker->numberBetween(0,60);
                $annonce =$this->getReference($annonceReference);
                /** @var Annonce $annonce *///il est pas obligatoir (03/07/2020 10h20)7min


                $com->setAnoonce($annonce);

                $manager->persist($com);
            }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            AnnonceFixtures::class,
        ];


    }
}
