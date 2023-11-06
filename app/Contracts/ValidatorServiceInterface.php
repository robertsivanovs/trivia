<?php

declare (strict_types=1);
namespace App\Contracts;

interface ValidatorServiceInterface
{
    public function validate(\Illuminate\Http\Client\Response $response): bool;
}
