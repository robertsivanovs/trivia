<?php

declare (strict_types=1);
namespace App\Http\Controllers;

use App\Services\GameService;
use Illuminate\Http\Request;

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

        // Logic for fetching the question data

        // Procceed to the game question
        return view('trivia.question');   
    }
}
