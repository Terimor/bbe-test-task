<?php

namespace App\Api\Interfaces;

interface ApiResponseInterface
{
    public function isSuccess(): bool;
}