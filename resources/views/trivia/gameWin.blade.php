@extends('layouts.app')

@section('content')
    <h1>Congratulations!</h1>
    <p> You answered all {{ $questionData->currentQuestion }} questions correctly.
    <a href="{{ route('trivia.question') }}" class="btn btn-primary">Play Again</a>
@endsection
