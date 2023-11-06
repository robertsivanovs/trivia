<?php

declare(strict_types=1);
namespace App\Services;

use App\Models\Question;
use App\Contracts\ValidatorServiceInterface;
use App\Contracts\DataFetcherServiceInterface;

/**
 * QuestionService
 * 
 * Handles the logic for fetching and validating the question API data
 */
class QuestionService
{
    public function __construct(
        protected ValidatorServiceInterface $validatorServiceInterface,
        protected DataFetcherServiceInterface $dataFetcherServiceInterface
    ) {}

    /**
     * fetchQuestionData
     * 
     * Manage the operations needed to create the question for the game
     *
     * @return Question|bool
     */
    public function fetchQuestionData(): Question|bool
    {
        // Fetch the data from numbersapi
        $response = $this->dataFetcherServiceInterface->fetchApiData();

        if (!$response) {
            return false;
        }

        // Instantiate the validator class
        if (!$this->validatorServiceInterface->validate($response)) {
            return false;
        }

        $questionData = $response->json();

        // Extract the text, number, and answer options
        $text = $questionData['text'];
        $correctAnswer = $questionData['number'];

        // Generate the answers for the question
        $answers = $this->generateRandomAnswers($correctAnswer);

        // Return the question data
        return new Question($text, $correctAnswer, $answers);

    }
    
    /**
     * generateRandomAnswers
     * 
     * Generates a random amount if addiitonal answers for the game
     * 1-3 additional answers
     *
     * @param int|float $correctAnswer
     * @return array
     */
    private function generateRandomAnswers(int|float $correctAnswer): array
    {
        $answerOptions = [$correctAnswer];
        // Randomize how many incorrect answers to generate min 1 max 3
        $answerCount = rand(1, 3);

        // Generate random numbers as incorrect answers
        for ($i = 0; $i < $answerCount; $i++) {
            $answerOptions[] = rand();
        }

        // Shuffle answer order
        shuffle($answerOptions);

        return $answerOptions;
    }
}
