<?php

declare (strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Question
 */
class Question extends Model
{
    use HasFactory;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        public string       $text, 
        public string       $correctAnswer, 
        public array        $answers
    ) {}
}
