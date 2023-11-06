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
     * @return array|bool
     */
    public function fetchQuestionData(): \App\Models\Question|bool
    {
        return $this->questionService->fetchQuestionData();
    }
    
    /**
     * storeQuestionInSession
     * 
     * Stores the current question in user session
     *
     * @param  mixed $question
     * @return void
     */
    public function storeQuestionInSession(\App\Models\Question $question): void
    {
        $this->gameSessionService->storeQuestionInSession($question);
    }
    
    /**
     * fetchQuestionFromSession
     * 
     * Fetches the current question from the session
     *
     * @return App\Models\Question|bool
     */
    public function fetchQuestionFromSession(): \App\Models\Question|bool
    {
        return $this->gameSessionService->fetchQuestionFromSession() ?? false;
    }
    
    /**
     * deleteQuestionFromSession
     * 
     * Deletes the answered question from session
     *
     * @return void
     */
    public function deleteQuestionFromSession(): void
    {
        $this->gameSessionService->deleteQuestionFromSession();
    }

}
