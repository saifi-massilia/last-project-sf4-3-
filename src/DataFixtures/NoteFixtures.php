<?php

namespace App\DataFixtures;


use App\Entity\Note;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NoteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker=Factory::create('fr_FR');
            //GENERER 20 COMMENTAIRES
            for ($i=0;$i<20;$i++){
                $note=new Note();
                $note
                    ->setNote($faker->numberBetween(1,5))
                    ->setCreation($faker->dateTimeAD($max = 'now', $timezone = null))
                    ->setAvis($faker->text(500))
                    ;

                $userReference ='user_' .$faker->numberBetween(0,59);
                $user =$this->getReference($userReference);



                $note->setAuteur($user);

                $userReference ='user_' .$faker->numberBetween(0,59);
                $user =$this->getReference($userReference);



                $note->setUtilisateur($user);




                $manager->persist($note);
            }

        $manager->flush();
    }
}
