<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixtures
{

    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager): void
    {
        $this->create(User::class, function (User $user) {
            $user
                ->setEmail('admin@mail.com')
                ->setFirstName('Администратор')
                ->setPassword($this->passwordEncoder->encodePassword($user, '123456'))
                ->setRoles(['ROLE_ADMIN'])
            ;
        });

        $this->createMany(User::class, 10, function (User $user) {
           $user
                ->setEmail($this->faker->email)
               ->setFirstName($this->faker->firstName)
               ->setPassword($this->passwordEncoder->encodePassword($user, '123456'))
           ;
        });
    }
}
