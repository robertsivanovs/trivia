<?php

declare (strict_types=1);
namespace App\Http\Controllers;

use App\Services\GameService;
use App\Http\Requests\AnswerValidationRequest;

/**
 * GameController
 * 
 * Main Trivia game controller
 * @author Roberts Ivanovs
 * 
 * Handles most of the data needed for the application.
 * Business logic and most functionality is seperated in Service classes
 * to imply SOLID code principles and good practices.
 * 
 */
class GameController extends Controller
{    
    /**
     * __construct
     * 
     * PHP 8+: Constructor property promotion
     *
     * @return void
     */
    public function __construct(
        protected GameService $gameService
    ) {}
        
    /**
     * startGame
     * 
     * Sets the required session variables and starts the game
     *
     * @return void
     */
    public function startGame()
    {
        $this->gameService->startGame();
        return view('trivia.start');
    }
    
    /**
     * fetchQuestion
     * 
     * Handles fetching the question data from services and redirects
     *
     * @return void
     */
    public function fetchQuestion()
    {
        $questionNumber = $this->gameService->getCurrentQuestionNumber();
        // If session variables are not set
        if ($questionNumber < 1) {
            return view('index');
        }

        // Check if there is a question already in the current session
        $questionData = $this->gameService->fetchQuestionFromSession();

        // Do not fetch a new question untill the current one is answered
        if (!empty($questionData)) {
            // Procceed to the game question
            return view('trivia.question', compact('questionData'));
        }

        // Fetch new question data if all current ones from session are answered
        $questionData = $this->gameService->fetchQuestionData();

        if (!$questionData) {
            return view('index');
        }

        // Add current question count to question
        $questionData->currentQuestion = $questionNumber;
        // Store the current question in the session
        $this->gameService->storeQuestionInSession($questionData);

        // Procceed to the game question
        return view('trivia.question', compact('questionData'));
    }
    
    /**
     * checkAnswer
     * 
     * Handles the user provided answers & redirects.
     *
     * @param \App\Http\Requests\AnswerValidationRequest $answerValidationRequest
     * @return void
     */
    public function checkAnswer(AnswerValidationRequest $answerValidationRequest)
    {
        // Validate user input
        $validateData = $answerValidationRequest->validated();
        $questionNumber = $this->gameService->getCurrentQuestionNumber();

        // If data was not validated
        if (!$validateData) {
            return view('index');
        }

        // Gather user POST data & Question data
        $userAnswer = $validateData['answer'];
        $questionData = $this->gameService->fetchQuestionFromSession();

        // User has answered all questions correctly
        if ($questionNumber >= config('game.trivia.game_question_count')) {
            // Delete all session data and return user to Game Win view
            $this->gameService->deleteSessionData();
            return view('trivia.gameWin', compact('questionData', 'userAnswer'));
        }

        // Delete the answered question from session
        $this->gameService->deleteQuestionFromSession();

        // Check if the answer was correct or not
        $answerCorrect = $this->gameService->checkAnswer($userAnswer, $questionData->correctAnswer);

        // If the answer was not correct
        if (!$answerCorrect) {
            // Delete all session data and redirect user to Game Over view
            $this->gameService->deleteSessionData();
            return view('trivia.gameOver', compact('questionData', 'userAnswer'));
        }

        // Increment the question number and proceed to the next question
        $this->gameService->incrementCurrentQuestion();
        return $this->fetchQuestion();

    }

}
