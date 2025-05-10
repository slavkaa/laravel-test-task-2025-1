<?php

namespace App\Services\Game;

use App\DTOs\Factories\CreateGameResultDtoFactory;
use App\DTOs\Game\GameResultDto;
use App\Repositories\Game\GameResultsRepositoryInterface;

readonly class GameService implements GameServiceInterface
{
    public function __construct(
        protected CreateGameResultDtoFactory     $gameDtoFactory,
        protected GameResultsRepositoryInterface $gameRepository,
    ) { }

    public function play(): GameResultDto
    {
        $result = $this->generateResult();
        $status = $this->getStatus($result);
        $winPoints = $this->getWinPoints($result, $status);

        $dto = $this->gameDtoFactory->createGameResultDto($status, $winPoints, $result);

        $this->gameRepository->saveToHistory($dto);

        return $dto;
    }

    public function getHistory(): array
    {
        return $this->gameRepository->getHistory();
    }

    // --- protected ---------------------------------------------------------------------------

    protected function generateResult()
    {
        return rand(0, 1000);
    }

    protected function getStatus(int $result): bool
    {
        if ($result%2 === 0) {
            return true;
        }

        return false;
    }

    protected function getWinPoints(int $result, bool $status): int
    {
        if ($status === false) {
            return 0;
        }

        if (900 < $result) {
            return (int) ($result * 0.7);
        } elseif (600 < $result) {
            return (int) ($result * 0.5);
        } elseif (300 < $result) {
            return (int) ($result * 0.3);
        }

        return (int) ($result * 0.1);
    }
}
