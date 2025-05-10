<?php

namespace App\Services\Game;

use App\DTOs\Factories\CreateGameResultDtoFactory;
use App\DTOs\Game\GameResultDto;
use App\Repositories\Game\GameResultsRepositoryInterface;

interface GameServiceInterface
{
   public function play(): GameResultDto;

    public function getHistory(): array;
}
