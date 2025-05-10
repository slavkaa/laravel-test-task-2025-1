<?php

namespace App\DTOs\Game;

class GameResultDto
{
    public function __construct(
        protected readonly string $status,
        protected readonly int $winPoints,
        protected readonly int $realScore
    )
    { }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getWinPoints(): int
    {
        return $this->winPoints;
    }

    public function getRealScore(): int
    {
        return $this->realScore;
    }
}
