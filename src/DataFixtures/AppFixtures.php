<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Etudiant;
Use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture

{
    /**
     * @var passwordEncoderInterface
     */
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this ->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $etudiant = new Etudiant();
            $etudiant->SetNom('Nom'. $i);
            $etudiant->SetPrenom('Prenom' .$i);
            $etudiant->SetAge(0 .$i);
            $etudiant->SetAnnee(0 .$i);
            $manager->persist($etudiant);  
        }
        $manager->flush();
    

        for($i = 1; $i <= 10; $i++){
            $user = new User();
            $user -> setEmail('admin' . $i . '@gmail');
            $user -> setPassword($this->passwordEncoder->encodePassword($user,'password', null));
            $user->setApiKey('apikeytest'.$i);
        }
        $manager->flush();
    }
}
