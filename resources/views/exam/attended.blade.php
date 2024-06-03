@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Attended Exams</h2>
    
    @if($examResults->isEmpty())
        <p>You have not attended any exams.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Exam Name</th>
                    <th>Mark</th>
                    <th>Status</th>
                    <th>Pass Mark</th>
                </tr>
            </thead>
            <tbody>
                @foreach($examResults as $result)
                    <tr>
                        <td>{{ $result->exam->name }}</td>
                        <td>{{ $result->mark }}</td>
                        <td>{{ $result->passed ? 'Passed' : 'Failed' }}</td>
                        <td>{{ $result->exam->pass_mark }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
