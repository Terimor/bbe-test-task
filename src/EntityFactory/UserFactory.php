<?php

namespace App\EntityFactory;

use App\Api\Dto\Request\ApiRegisterRequestDto;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(ApiRegisterRequestDto $registerDto): User
    {
        $user = new User();

        $user->setEmail($registerDto->getEmail());

        $hashedPassword = $this->passwordHasher->hashPassword($user, $registerDto->getPassword());
        $user->setPassword($hashedPassword);

        return $user;
    }
}