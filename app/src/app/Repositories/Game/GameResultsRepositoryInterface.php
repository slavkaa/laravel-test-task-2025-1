<?php

namespace App\Repositories\Game;

use App\DTOs\Game\GameResultDto;

interface GameResultsRepositoryInterface
{
    public function saveToHistory(GameResultDto $dto): void;

    public function getHistory(): array;
}
