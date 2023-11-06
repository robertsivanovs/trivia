@extends('layouts.app')

@section('content')
    <h3>Question Nr:. {{ $questionData->currentQuestion }}</h3>
    <h2>{{ $questionData->text }}</h2>
    <form action="/answer" method="post">
        @csrf
        <label>Your Answer:</label>
        <ul>
            @foreach($questionData->answers as $answer)
                <li>
                    <input type="radio" name="answer" value="{{ $answer }}" required>
                    <span>{{ $answer }}</span>
                </li>
            @endforeach
        </ul>
        @error('answer')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit">Submit Answer</button>
    </form>
@endsection
