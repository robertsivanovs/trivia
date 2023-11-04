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
        return view("trivia.start");
    }

    public function fetchQuestion()
    {
        
    }
}
