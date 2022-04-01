<?php

namespace App\Api\Controller;

use App\Api\Builder\ApiRequestBuilder;
use App\Api\Builder\ApiResponseBuilder;
use App\Api\Dto\Request\ApiRegisterRequestDto;
use App\Api\Dto\Response\ApiSuccessResponseDto;
use App\EntityFactory\UserFactory;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(
        private readonly ApiRequestBuilder $requestBuilder,
        private readonly ApiResponseBuilder $responseBuilder
    ) {
    }

    #[Route('/api/register', name: 'register')]
    public function register(Request $request, UserFactory $userFactory, UserRepository $userRepository): JsonResponse
    {
        /** @var ApiRegisterRequestDto $registerDto */
        $registerDto = $this->requestBuilder->build(ApiRegisterRequestDto::class, $request->getContent());

        $user = $userFactory->create($registerDto);
        $userRepository->add($user);

        return $this->responseBuilder->build(new ApiSuccessResponseDto());
    }
}