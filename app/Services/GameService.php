<?php

declare (strict_types=1);
namespace App\Services;

use App\Services\GameSessionService;
use App\Services\QuestionService;
use App\Services\AnswerService;

/**
 * GameService
 * 
 * @author Roberts Ivanovs
 * 
 * Layer between the main game controller and all Service classes
 * Instantiates other Services that are responsible for the business logic.
 * 
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
        protected QuestionService $questionService,
        protected AnswerService $answerService
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
     * Returns the current question count
     *
     * @return bool
     */
    public function getCurrentQuestionNumber(): int
    {
        return $this->gameSessionService->getCurrentQuestionNumber();
    }
    
    /**
     * incrementCurrentQuestion
     * 
     * Increase the current question by 1
     * Happens when user answers correctly to the question
     *
     * @return void
     */
    public function incrementCurrentQuestion(): void
    {
        $this->gameSessionService->incrementCurrentQuestion();
    }
    
    /**
     * fetchQuestionData
     * 
     * Return the data needed for displaying the question
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
    
    /**
     * deleteSessionData
     * 
     * Completely deletes all current session data
     *
     * @return void
     */
    public function deleteSessionData(): void
    {
        $this->gameSessionService->deleteSessionData();
    }
    
    /**
     * checkAnswer
     * 
     * Checks if the user provided answer was correct or not
     *
     * @param string $userAnswer
     * @param string $correctAnswer
     * @return bool
     */
    public function checkAnswer(string $userAnswer, string $correctAnswer): bool
    {
        return $this->answerService->checkAnswer($userAnswer, $correctAnswer);
    }

}
