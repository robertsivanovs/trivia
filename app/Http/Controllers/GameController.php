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
        // Session variables are not set
        if (!$this->gameService->checkSessionData()) {
            // TO DO: add error logging
            return view('index');
        }

        // Check if the current question is in the session
        $questionData = $this->gameService->fetchQuestionFromSession();

        // Do not fetch a new question untill the current one is answered correctly
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

        // Store the current question in the session
        $this->gameService->storeQuestionInSession($questionData);

        // Procceed to the game question
        return view('trivia.question', compact('questionData'));
    }

    public function checkAnswer(AnswerValidationRequest $answerValidationRequest)
    {
        if (!$answerValidationRequest->isMethod('post')) {
            return view('index');
        }

        // Validate user input
        $validateData = $answerValidationRequest->validated();
        // If data was not validated
        if (!$validateData) {
            return view('index');
        }

        // Gather user POST data & Question data
        $userAnswer = $answerValidationRequest->input('answer');
        $questionData = $this->gameService->fetchQuestionFromSession();

        // If the answer is not correct
        if ($userAnswer != $questionData->correctAnswer) {
            // To Do: Add data for the unanswered question
            var_dump("Game over");
            die();
        }

        // Uer answered the question correctly
        $this->gameService->deleteQuestionFromSession();
        // Proceed to the next question
        return $this->fetchQuestion();

    }

}
