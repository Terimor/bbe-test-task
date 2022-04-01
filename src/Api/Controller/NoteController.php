<?php

namespace App\Api\Controller;

use App\Api\Builder\ApiRequestBuilder;
use App\Api\Builder\ApiResponseBuilder;
use App\Api\Dto\Request\ApiNoteRequestDto;
use App\Api\Dto\Response\ApiNoteResponseDto;
use App\Api\Dto\Response\ApiNotesResponseDto;
use App\Api\Dto\Response\ApiSuccessResponseDto;
use App\EntityFactory\NoteFactory;
use App\Repository\NoteRepository;
use App\Service\UserProviderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class NoteController extends AbstractController
{
    public function __construct(
        private readonly ApiRequestBuilder $requestBuilder,
        private readonly ApiResponseBuilder $responseBuilder,
        private readonly NoteRepository $noteRepository,
        private readonly UserProviderService $userProviderService
    ) {
    }

    #[Route('/api/notes', name: 'notes_get', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $user = $this->userProviderService->getUser();
        $notes = $this->noteRepository->findByUser($user);

        $response = new ApiNotesResponseDto($notes);

        return $this->responseBuilder->build($response);
    }

    #[Route('/api/notes/{id<\d+>}', name: 'note_get', methods: ['GET'])]
    public function getOne(int $id): JsonResponse
    {
        $user = $this->userProviderService->getUser();
        $note = $this->noteRepository->find($id);
        if (!$note) {
            throw new NotFoundHttpException();
        }
        if ($note->getUser() !== $this->userProviderService->getUser()) {
            throw new AccessDeniedHttpException();
        }

        $response = new ApiNoteResponseDto($note);

        return $this->responseBuilder->build($response);
    }

    #[Route('/api/notes', name: 'note_create', methods: ['POST'])]
    public function create(Request $request, NoteFactory $noteFactory): JsonResponse
    {
        $noteDto = $this->requestBuilder->build(ApiNoteRequestDto::class, $request->getContent());

        $note = $noteFactory->create($noteDto->getNote());
        $this->noteRepository->add($note);

        return $this->responseBuilder->build(new ApiSuccessResponseDto());
    }

    #[Route('/api/notes/{id<\d+>}', name: 'note_update', methods: ['PATCH'])]
    public function update(Request $request, int $id): JsonResponse
    {
        /** @var ApiNoteRequestDto $noteDto */
        $noteDto = $this->requestBuilder->build(ApiNoteRequestDto::class, $request->getContent());

        $note = $this->noteRepository->find($id);
        if (!$note) {
            throw new NotFoundHttpException();
        }
        if ($note->getUser() !== $this->userProviderService->getUser()) {
            throw new AccessDeniedHttpException();
        }

        $note->setNote($noteDto->getNote());
        $this->noteRepository->flush();

        return $this->responseBuilder->build(new ApiSuccessResponseDto());
    }

    #[Route('/api/notes/{id<\d+>}', name: 'note_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $note = $this->noteRepository->find($id);
        if (!$note) {
            throw new NotFoundHttpException();
        }
        if ($note->getUser() !== $this->userProviderService->getUser()) {
            throw new AccessDeniedHttpException();
        }

        $this->noteRepository->remove($note);

        return $this->responseBuilder->build(new ApiSuccessResponseDto());
    }
}