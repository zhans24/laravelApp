<?php

namespace App\Http\Controllers;

use App\Application\DTO\Input\CreateReviewInputDTO;
use App\Application\UseCases\AddReviewUseCase;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    private AddReviewUseCase $createUseCase;

    public function __construct(AddReviewUseCase $createUseCase)
    {
        $this->createUseCase = $createUseCase;
    }

    public function store(StoreReviewRequest $request): JsonResponse
    {
        $inputDTO = CreateReviewInputDTO::fromRequest($request);
        $outputDTO = $this->createUseCase->execute($inputDTO);
        return response()->json($outputDTO, 201);
    }
}
