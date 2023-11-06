@extends('layouts.app')

@section('content')
    <h1>Game Over!</h1>
    <p> You answered {{ $questionData->currentQuestion - 1 }} questions correctly.
    <p>However the answer provided to the last question was not correct!</p>
    <p>Question: </p>
    <h3>{{ $questionData->text }}</h3>
    <p> Your answer: {{ $userAnswer }}</p>
    <p>Correct Answer: {{ $questionData->correctAnswer }}</p>

    <a href="{{ route('trivia.question') }}" class="btn btn-primary">Play Again</a>
@endsection
