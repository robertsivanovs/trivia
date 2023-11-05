<?php

declare (strict_types=1);
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Contracts\DataFetcherServiceInterface;

/**
 * ApiDataFetcherService
 * 
 * Handles the API request for fetching the game question data
 * 
 */
class DataFetcherService implements DataFetcherServiceInterface
{    
    /**
     * fetchApiData
     * 
     * Fetch the question data from the numbersapi API endpoint.
     *
     * @return \Illuminate\Http\Client\Response|bool
     */
    public function fetchApiData(): \Illuminate\Http\Client\Response|bool
    {
        try {
            $response = Http::get(config('api.trivia.endpoint'));
        } catch (\Exception $e) {
            Log::error('API request failed: ' . $e->getMessage());
            return false;
        }

        return $response;
    }
}
