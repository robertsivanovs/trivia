<?php

declare (strict_types=1);
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Contracts\ValidatorServiceInterface;

/**
 * ValidatorService
 * 
 * Handles API response validation
 */
class ValidatorService implements ValidatorServiceInterface
{
    /**
     * validate
     * 
     * Validate the response received from the numbersapi API endpoint.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return bool
     */
    public function validate(\Illuminate\Http\Client\Response $response): bool
    {
        if (!$response->successful()) {
            Log::error('API request failed with status code: ' . $response->status());
            return false;
        }

        $responseData = $response->json();

        // Check if the required data is present in the response
        if (!$responseData['found'] || $responseData['type'] !== 'trivia') {
            Log::error('Invalid response data');
            return false;
        }

        if (!isset($responseData['text']) || !isset($responseData['number'])) {
            Log::error('Missing required data in response');
            return false;
        }

        return true;
    }
}
