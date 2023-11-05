<?php

declare (strict_types=1);
namespace App\Services;

use App\Services\GameSessionService;
use App\Services\QuestionService;

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
        protected GameSessionService $gameSessionService,
        protected QuestionService $questionService
    ) {}

    /**
     * startGame
     * 
     * Instantiates the Session manager to create required
     * session variables.
     *
     * @return void
     */
    public function startGame(): void
    {
        // Set session variables
        $this->gameSessionService->startGame();
    }
    
    /**
     * checkSessionData
     * 
     * Check if the user session contains required variables
     *
     * @return bool
     */
    public function checkSessionData(): bool
    {
        return $this->gameSessionService->checkSessionData();
    }
    
    
    /**
     * fetchQuestionData
     *
     * @return void
     */
    public function fetchQuestionData(): array|bool
    {
        return $this->questionService->fetchQuestionData();
    }

}
