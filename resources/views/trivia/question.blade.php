@extends('layouts.app')

@section('content')
<div class="question-container">
    <h3 class="question-number">Question Nr. {{ $questionData->currentQuestion }}</h3>
    <h2 class="question-text">{{ $questionData->text }}</h2>

    <form action="/answer" method="post" class="answer-form">
        @csrf

        <label for="answer" class="answer-label">Your Answer:</label>

        <ul class="answer-options">
            @foreach($questionData->answers as $answer)
                <li class="answer-option">
                    <input type="radio" name="answer" value="{{ $answer }}" id="answer{{ $loop->index }}" required>
                    <label for="answer{{ $loop->index }}">{{ $answer }}</label>
                </li>
            @endforeach
        </ul>

        @error('answer')
        <div class="error-message">{{ $message }}</div>
        @enderror

        <button type="submit" class="submit-button">Submit Answer</button>
    </form>
</div>
@endsection
