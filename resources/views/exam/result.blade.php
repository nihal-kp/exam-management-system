@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Exam Result</h2>
    <p>Score: {{ $result->mark }}</p>
    <p>Status: {{ $result->passed == 1 ? 'Passed' : 'Failed' }}</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Back to Exams</a>
</div>
@endsection