@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $exam->name }}</h2>
    <p>Duration: {{ $exam->duration }} minutes</p>
    <p>Pass Mark: {{ $exam->pass_mark }}</p>

    <form id="exam-form" action="{{ route('exam.submit', $exam->id) }}" method="POST">
        @csrf
        @foreach($exam->examQuestions as $question)
            <div class="form-group">
                <label>{{ $question->question }}</label>
                <div>
                    <input type="radio" name="answers[{{ $question->id }}]" value="a" required>
                    <label>{{ $question->choice_a }}</label>
                </div>
                <div>
                    <input type="radio" name="answers[{{ $question->id }}]" value="b" required>
                    <label>{{ $question->choice_b }}</label>
                </div>
                <div>
                    <input type="radio" name="answers[{{ $question->id }}]" value="c" required>
                    <label>{{ $question->choice_c }}</label>
                </div>
                <div>
                    <input type="radio" name="answers[{{ $question->id }}]" value="d" required>
                    <label>{{ $question->choice_d }}</label>
                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit Exam</button>
    </form>

    <div id="timer">
        Time Left: <span id="time-left">{{ $exam->duration }}:00</span>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).ready(function() {
    let timeLeft = {{ $exam->duration }} * 60;
    const timerElement = $('#time-left');

    const timer = setInterval(function() {
        if (timeLeft <= 0) {
            clearInterval(timer);
            $('#exam-form').submit();
        } else {
            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.text(`${minutes}:${seconds < 10 ? '0' : ''}${seconds}`);
        }
    }, 1000);
});
</script>
@endpush