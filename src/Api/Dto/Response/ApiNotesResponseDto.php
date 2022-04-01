<?php

namespace App\Api\Dto\Response;

use JMS\Serializer\Annotation\Type;

class ApiNotesResponseDto extends ApiSuccessResponseDto
{
    #[Type('array<App\Entity\Note>')]
    private array $notes;

    public function __construct(array $notes)
    {
        $this->notes = $notes;
    }
}