<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{ /**
 * @var UserPasswordEncoderInterface
 */
    private $passwordEncoder;

    /**
     * dans la majorité des classes, on peut recuperer des services par autowiring(cablage)
     * uniquement dans le constructeur
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        //generer 60 users
        for($i=0;$i<60;$i++){
            $user = new User();
            $hash = $this->passwordEncoder->encodePassword($user, 'user' . $i);
            $user
                ->setEmail('user'. $i .'@mail.com')
                ->setNom($faker->lastName)
                ->setPassword($hash)
                ->setPrenom($faker->firstName)
                ->setPseudo($faker->userName)
                ->setTelephone($faker->numerify('0#########'))
                ->setInscription($faker->dateTime)
                ->setRoles(['ROLE_USER'])

;


        $manager->persist($user);
        }

// Créer 5 moderateurs
        for ($i = 0; $i < 5; $i++) {
            $moderateur = new User();
            $hash = $this->passwordEncoder->encodePassword($moderateur, 'moderateur' . $i);
            $moderateur
                ->setEmail('mod' . $i . '@mail.com')
                ->setPassword($hash)
                ->setRoles(['ROLE_MODERATEUR'])
                ->setPseudo($faker->userName)
                ->setPrenom($faker->firstName)
                ->setNom($faker->lastName)
                ->setTelephone($faker->numerify('06########'))
                ->setInscription($faker->dateTimeBetween('-1 year'))
            ;
            $manager->persist($moderateur);
        }

        // Créer 2 admins
        for ($i = 0; $i < 2; $i++) {
            $admin = new User();
            $hash = $this->passwordEncoder->encodePassword($admin, 'admin' . $i);
            $admin
                ->setEmail('admin' . $i . '@mail.com')
                ->setPassword($hash)
                ->setRoles(['ROLE_ADMIN'])
                ->setPseudo($faker->userName)
                ->setPrenom($faker->firstName)
                ->setNom($faker->lastName)
                ->setTelephone($faker->numerify('06########'))
                ->setInscription($faker->dateTimeBetween('-1 year'))
            ;


            $manager->persist($admin);
        }
        $manager->flush();
    }
}