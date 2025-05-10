<?php

namespace App\Http\Controllers;

use App\Services\Game\GameService;
use App\Services\Game\GameServiceInterface;

class GameController extends AbstractController
{
    public function __construct(
        protected readonly GameServiceInterface $gameService,
    )
    { }

    public function iAmFeelingLucky(): object
    {
        $result = $this->gameService->play();

        return response()->json([
            'data' => [
                'status' => $result->getStatus(),
                'winPoints' => $result->getWinPoints(),
                'realScore' => $result->getRealScore()
            ],
        ]);
    }

    public function getHistory(): object
    {
        return response()->json([
            'data' => $this->gameService->getHistory()
        ]);
    }
}
