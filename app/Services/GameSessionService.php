<?php

declare (strict_types=1);
namespace App\Services;

use Illuminate\Http\Request;

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
        protected Request $request
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
        $this->request->session()->put('score', 0);
        $this->request->session()->put('current_question', 1);
    }

    public function checkSessionData()
    {
        // return $data = [
        //     $this->request->session()->get('score'),
        //     $this->request->session()->get('current_question'),
        // ];

        return ($this->request->session()->has('score') 
            && $this->request->session()->has('current_question'));
    }
}
