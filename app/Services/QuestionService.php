<?php

declare(strict_types=1);
namespace App\Services;

use App\Models\Question;
use App\Contracts\ValidatorServiceInterface;
use App\Contracts\DataFetcherServiceInterface;
use Illuminate\Support\Facades\Log;

/**
 * QuestionService
 * 
 * Handles the logic for fetching and validating the question API data
 */
class QuestionService
{    
    /**
     * __construct
     *
     * @return void
     */
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
        try {
            // Fetch the data from numbersapi
            $response = $this->dataFetcherServiceInterface->fetchApiData();

            if (!$response) {
                Log::error('Failed to fetch question data: No response');
                return false;
            }

            // Validate the response
            if (!$this->validatorServiceInterface->validate($response)) {
                Log::error('Failed to fetch question data: Invalid response');
                return false;
            }

            $questionData = $response->json();

            // Extract the text, number, and answer options
            $text = $this->processQuestionText($questionData['text']);
            $correctAnswer = (string)$questionData['number'];

            // Generate the answers for the question
            $answers = $this->generateRandomAnswers($correctAnswer);

            // Return the question data
            return new Question($text, $correctAnswer, $answers);
        } catch (\Exception $e) {
            Log::error('Error in fetchQuestionData: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * generateRandomAnswers
     * 
     * Generates a random amount if addiitonal answers for the game
     * 1-3 additional answers
     *
     * @param  string $correctAnswer
     * @return array
     */
    private function generateRandomAnswers(string $correctAnswer): array
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
    
    /**
     * processQuestionText
     * 
     * Removes the correct answer and the word "is" from 
     * the beginning of the question text that's received from the API
     * 
     * Example (0 is the coldest possible temperature old the Kelvin scale.)
     *
     * @param  string $rawText
     * @return string
     */
    private function processQuestionText(string $rawText): string
    {
        // Split the text into words
        $words = explode(' ', $rawText);

        // Find the position of "is" in the words array
        $isPosition = array_search('is', $words);

        if ($isPosition !== false && $isPosition > 0) {
            // Remove everything before "is" (including "is")
            $processedText = implode(' ', array_slice($words, $isPosition + 1));
        } else {
            // If "is" is not found or at the beginning, keep the original text
            $processedText = $rawText;
        }

        return $processedText;
    }

}
