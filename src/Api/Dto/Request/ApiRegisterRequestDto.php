<?php

namespace App\Api\Dto\Request;

use App\Api\Interfaces\ApiRequestInterface;
use JMS\Serializer\Annotation\Type;

class ApiRegisterRequestDto implements ApiRequestInterface
{
    #[Type("string")]
    private string $email;

    #[Type("string")]
    private string $password;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}