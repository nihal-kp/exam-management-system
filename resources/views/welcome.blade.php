@extends('layouts.app')

@section('content')
<div class="container mt-3">
  <h2 class="mb-4">Exams</h2>
  @if($exams->isEmpty())
    <p>No exams available.</p>
  @else
    <ul class="list-group">
      @foreach($exams as $exam)
        <li class="list-group-item">
          <h4>{{ $exam->name }}</h4>
          <p>Duration: {{ $exam->duration }} minutes</p>
          <p>Pass Mark: {{ $exam->pass_mark }}</p>
          @auth('student')
            <a href="{{ route('exam.show', $exam->id) }}" class="btn btn-primary">Apply</a>
          @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login to Apply</a>
          @endauth
        </li>
      @endforeach
    </ul>
  @endif
</div>

@endsection

@push('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        
        $('.parking-form').on('submit', function (event) {
            event.preventDefault();

            var currentForm = $(this);
            $.ajax({
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                url : currentForm.attr('action'),
                data: new FormData(currentForm[0]),
                success: function (response) {
                    
                    Swal.fire({
                        title: response.title,
                        text: response.text,
                        icon: response.icon,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    $('.error_msg').html('').hide();
                    currentForm[0].reset();
                },
                error: function (response) {
                    $('.error_msg').html('').hide();
                    $.each(response.responseJSON.errors, function(key,value) {
                        $('#error_'+key).html(value).show();
                    });

                    // Swal.fire({
                    //     title: 'Error',
                    //     text: 'An error occurred while submitting the form.',
                    //     icon: 'error',
                    //     showConfirmButton: false,
                    //     timer: 3000,
                    // });
                    // setTimeout(function() {
                    //     location.reload();
                    // },3000);
                }
            });
        });
    });
</script>
@endpush