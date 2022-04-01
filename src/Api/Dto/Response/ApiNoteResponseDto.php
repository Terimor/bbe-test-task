<?php

namespace App\Api\Dto\Response;

use App\Entity\Note;
use JMS\Serializer\Annotation\Type;

class ApiNoteResponseDto extends ApiSuccessResponseDto
{
    #[Type(Note::class)]
    private Note $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }
}