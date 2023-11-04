@extends('layouts.app')

@section('content')
    <h1>Welcome to the Trivia Quiz Game!</h1>
    <a href="{{ route('trivia.question') }}" class="btn btn-primary">Start Game</a>
@endsection
