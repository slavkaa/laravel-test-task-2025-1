<?php

namespace App\Repositories\Game;

use App\DTOs\Game\GameResultDto;
use function Laravel\Prompts\confirm;

class GameResultsRepository implements GameResultsRepositoryInterface
{
    protected const SESSION_KEY = 'game_results_history';

    public function saveToHistory(GameResultDto $dto): void
    {
        $history = $this->getHistory();

        $this->addToTop(
            $history,
            $this->normalizeGameResultDto($dto),
            config( 'app.game_history_length')
        );

        session([static::SESSION_KEY => $history]);
    }

    public function getHistory(): array
    {
        return session(static::SESSION_KEY, []);
    }

    protected function addToTop(array &$stack, array $newItem, int $max): void
    {
        array_unshift($stack, $newItem);
        if (count($stack) > $max) {
            array_pop($stack);
        }
    }

    protected function normalizeGameResultDto(GameResultDto $dto): array
    {
        return [
            'status' => $dto->getStatus(),
            'win_points' => $dto->getWinPoints()
        ];
    }
}
