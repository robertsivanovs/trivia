<?php

declare (strict_types=1);
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * GameSessionService
 * 
 * Class used for managing the Trivia game session
 */
class GameSessionService 
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        protected Request $request,
    ) {}

    /**
     * startGame
     *
     * Sets the session variables required for starting the game
     * 
     * @return void
     */
    public function startGame()
    {
        $this->request->session()->put('current_question', 1);
        // Regenerate session ID for additional security
        $this->request->session()->regenerate();
    }
    
    /**
     * getCurrentQuestionNumber
     * 
     * Gets the current question count from the session
     *
     * @return int
     */
    public function getCurrentQuestionNumber(): int
    {
        return $this->request->session()->get('current_question') ?? 0;
    }
    
    /**
     * storeQuestionInSession
     * 
     * Set the question data in the current session
     *
     * @param \App\Models\Question $question
     * @return void
     */
    public function storeQuestionInSession(\App\Models\Question $question): void
    {
        $this->request->session()->put('question_data', $question);
        // Regenerate session ID for additional security
        $this->request->session()->regenerate();
    }
    
    /**
     * fetchQuestionFromSession
     * 
     * Get the question data from the current session
     *
     * @return App\Models\Question|null
     */
    public function fetchQuestionFromSession(): ?\App\Models\Question
    {
        try {
            return $this->request->session()->get('question_data');
        } catch (\Exception $e) {
            Log::error('Error in fetchQuestionFromSession: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * deleteQuestionFromSession
     * 
     * Delete the question data from the current session
     *
     * @return void
     */
    public function deleteQuestionFromSession(): void
    {
        $this->request->session()->forget('question_data');
    }
    
    /**
     * incrementCurrentQuestion
     * 
     * Increase current question count by 1
     * Used when the user answers correctly to the question
     *
     * @return void
     */
    public function incrementCurrentQuestion(): void
    {
        try {
            $questionCount = $this->request->session()->get('current_question');
            $questionCount++;
            $this->request->session()->put('current_question', $questionCount);
        } catch (\Exception $e) {
            Log::error('Error in incrementCurrentQuestion: ' . $e->getMessage());
        }
    }
    
    /**
     * deleteSessionData
     * 
     * Deletes all Quiz session data
     *
     * @return void
     * @throws Exception
     */
    public function deleteSessionData(): void
    {
        try {
            $this->request->session()->flush();
        } catch (\Exception $e) {
            // Log an error
            Log::error('Error in deleteSessionData: ' . $e->getMessage());
        }
    }

}
