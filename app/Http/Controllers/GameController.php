<?php

declare (strict_types=1);
namespace App\Http\Controllers;

use App\Services\GameService;
use App\Http\Requests\AnswerValidationRequest;

/**
 * GameController
 * 
 */
class GameController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        protected GameService $gameService
    ) {}
        
    /**
     * startGame
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
     * @return void
     */
    public function fetchQuestion()
    {
        $questionNumber = $this->gameService->getCurrentQuestionNumber();
        // If session variables are not set
        if ($questionNumber < 1) {
            // TO DO: add error logging
            return view('index');
        }

        // Check if the current question is in the session
        $questionData = $this->gameService->fetchQuestionFromSession();

        // Do not fetch a new question untill the current one is answered
        if (!empty($questionData)) {
            // Procceed to the game question
            return view('trivia.question', compact('questionData'));
        }

        // Fetch new question data if all current ones from session are answered
        $questionData = $this->gameService->fetchQuestionData();

        if (!$questionData) {
            // TO DO: add error logging
            return view('index');
        }

        // Add current question count to question
        $questionData->currentQuestion = $questionNumber;
        // Store the current question in the session
        $this->gameService->storeQuestionInSession($questionData);

        // Procceed to the game question
        return view('trivia.question', compact('questionData'));
    }

    public function checkAnswer(AnswerValidationRequest $answerValidationRequest)
    {
        // Validate user input
        $validateData = $answerValidationRequest->validated();

        // If data was not validated
        if (!$validateData) {
            return view('index');
        }

        // Gather user POST data & Question data
        $userAnswer = $validateData['answer'];
        $questionData = $this->gameService->fetchQuestionFromSession();

        // Delete the answered question from session
        $this->gameService->deleteQuestionFromSession();

        // Check if the answer was correct or not
        $answerCorrect = $this->gameService->checkAnswer($userAnswer, $questionData->correctAnswer);

        // If the answer was not correct
        if (!$answerCorrect) {
            return view('trivia.gameOver', compact('questionData', 'userAnswer'));
        }

        // Increment the question number and proceed to the next question
        $this->gameService->incrementCurrentQuestion();
        return $this->fetchQuestion();

    }

}
