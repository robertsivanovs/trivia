<?php

declare(strict_types=1);
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * QuestionService
 * 
 * Handles the logic for fetching and validating the question API data
 */
class QuestionService
{
    /**
     * fetchQuestionData
     * 
     * Fetch the question data from the numbersapi API endpoint.
     *
     * @return json|bool
     */
    public function fetchQuestionData(): array|bool
    {
        try {
            $response = Http::get(config('api.trivia.endpoint'));
        } catch (\Exception $e) {
            Log::error('API request failed: ' . $e->getMessage());
            return false;
        }

        if (!$this->validateResponse($response)) {
            return false;
        }

        return $response->json();
    }

    /**
     * validateResponse
     * 
     * Validate the response received from the numbersapi API endpoint.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return bool
     */
    private function validateResponse(\Illuminate\Http\Client\Response $response): bool
    {
        if (!$response->successful()) {
            Log::error('API request failed with status code: ' . $response->status());
            return false;
        }

        $responseData = $response->json();

        if (!$responseData['found'] || $responseData['type'] !== 'trivia') {
            Log::error('Invalid response data');
            return false;
        }

        return true;
    }
}
