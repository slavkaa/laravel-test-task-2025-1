<?php

namespace App\DTOs\Factories;

use App\DTOs\Game\GameResultDto;

class CreateGameResultDtoFactory
{
    protected const WIN = 'WIN';
    protected const LOSE = 'LOSE';

    public static function createGameResultDto(bool $status, int $winPoints, int $realScore): GameResultDto
    {
        return new GameResultDto(
            $status ? static::WIN : static::LOSE,
            $winPoints,
            $realScore
        );
    }
}
