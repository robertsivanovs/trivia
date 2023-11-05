@extends('layouts.app')

@section('content')
    <h3>Question Nr:. X</h3>
    <h2>{{ $questionData->text }}</h2>
    <form action="/check-answer" method="post">
        @csrf
        <input type="hidden" name="correct_answer" value="{{ $questionData->correct_answer }}">
        <label for="answer">Your Answer:</label>
        <ul id="answer" name="answer">
            @foreach($questionData->answers as $answer)
            <input type="radio" name="answer-option" value="{{ $answer }}">
            <span>{{ $answer }}</span>
            <br />
            @endforeach
        </ul>
        <button type="submit">Submit Answer</button>
    </form>

@endsection
