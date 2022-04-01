<?php

namespace App\EntityFactory;

use App\Entity\Note;
use App\Service\UserProviderService;

class NoteFactory
{
    public function __construct(private readonly UserProviderService $userProviderService)
    {
    }

    public function create(string $noteText): Note
    {
        $note = new Note();

        $note->setNote($noteText);

        $user = $this->userProviderService->getUser();
        $note->setUser($user);

        return $note;
    }
}