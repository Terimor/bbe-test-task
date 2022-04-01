<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\UnauthorizedException;
use Symfony\Component\Security\Core\Security;

class UserProviderService
{
    public function __construct(private readonly Security $security)
    {
    }

    public function getUser(): User
    {
        /** @var User $user */
        $user = $this->security->getUser();

        if (!$user) {
            throw new UnauthorizedException();
        }

        return $user;
    }
}