@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="trivia-game-over">
            <h1 class="game-over-caption">Game Over!</h1>
            <p class="incorrect-description">You answered {{ $questionData->currentQuestion - 1 }} questions correctly.</p>
            <p class="incorrect-description">However, the answer provided to the last question was not correct.</p>
            <hr>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-caption">Question:</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $questionData->text }}</h5>
                    <p class="card-text">Your answer: {{ $userAnswer }}</p>
                    <p class="card-text">Correct Answer: {{ $questionData->correctAnswer }}</p>
                </div>
            </div>
            
            <div class="play-again">
                <a href="{{ route('trivia.question') }}" class="btn btn-primary">Play Again</a>
            </div>
        </div>
    </div>
</div>
@endsection
