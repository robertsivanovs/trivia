<?php

declare (strict_types=1);
namespace App\Services;

/**
 * AnswerService
 */
class AnswerService
{    
    /**
     * checkAnswer
     *
     * Checks if the answer provided by the user is correct or not
     * 
     * @param string $userAnswer
     * @param string $correctAnswer
     * @return bool
     */
    public function checkAnswer(string $userAnswer, string $correctAnswer): bool
    {
        return $userAnswer == $correctAnswer;
    }
}
