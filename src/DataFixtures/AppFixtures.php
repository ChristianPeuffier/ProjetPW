<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Contact;
use App\Entity\Educateur;
use App\Entity\Licencie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i<10; $i++) {
            $contact = new Contact();
            $contact->setNom($this->faker->lastName())
                ->setPrenom($this->faker->firstName())
                ->setEmail($this->faker->email())
                ->setTelephone($this->faker->phoneNumber());

            $category = new Categorie();
            $category->setNom($this->faker->randomElement(['U7', 'U9', 'U11', 'U13', 'U15', 'U17', 'U19', 'Senior']))
                ->setCodeRaccourci($this->faker->randomElement(['U7', 'U9', 'U11', 'U13', 'U15', 'U17', 'U19', 'Senior']));


            $licencie = new Licencie();
            $licencie->setNumeroLicence($this->faker->numberBetween(100, 9999))
                ->setNom($this->faker->lastName())
                ->setPrenom($this->faker->firstName())
                ->setContact($contact)
                ->setCategorie($category);



            $educateur = new Educateur();
            $educateur->setEmail($this->faker->email())
                ->setRoles($this->faker->randomElement([['ROLE_ADMIN'], ['ROLE_EDUCATEUR']]));
                $number = $this->faker->numberBetween(0, 1);
                if ($number == 1) {
                    $educateur->setLicencie($licencie);
                }
                $educateur

                ->setPlainPassword('password');


            $manager->persist($category);
            $manager->persist($contact);
            $manager->persist($licencie);
            $manager->persist($educateur);
        }

        $manager->flush();
    }
}
