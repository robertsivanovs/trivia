<?php

declare (strict_types=1);
namespace App\Contracts;

interface DataFetcherServiceInterface
{
    public function fetchApiData(): \Illuminate\Http\Client\Response|bool;
}
