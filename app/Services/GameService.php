<?php

declare (strict_types=1);
namespace App\Services;

use App\Services\GameSessionService;

/**
 * GameService
 * 
 * Handles most of the Trivia game business logic
 */
class GameService 
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        protected GameSessionService $gameSessionService
    ) {}

    /**
     * startGame
     * 
     * Instantiates the Session manager to create required
     * session variables.
     *
     * @return void
     */
    public function startGame()
    {
        // Set session variables
        $this->gameSessionService->startGame();
    }

    public function checkSessionData()
    {
        return $this->gameSessionService->checkSessionData();
    }
}
