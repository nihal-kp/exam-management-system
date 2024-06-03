@extends("teacher.layouts.app")
@section('title', $exam->id ? 'Edit' : 'Add' . ' Exam')
@section("content")    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">{{ $exam->id ? 'Edit' : 'Add' }} Exam</h1>
        
        <form method="POST" action="{{ $exam->id ? route('teacher.exam.update',$exam->id) : route('teacher.exam.store') }}" enctype="multipart/form-data">
        @csrf
        {{ $exam->id ? method_field('PUT') : '' }}
        
        <div class="card-body">
            
            <h3 class="font-size-lg text-dark font-weight-bold mb-3">Exam</h3>
            <div class="row">
                <div class="form-group col-6">
                  <b><label for="usr">Name* :</label></b>
                  <input type="text" class="form-control" name="name" value="{{old('name', ($exam->name ? $exam->name : '' ))}}" required>
                  @error("name")
    				<p style="color:red">{{$errors->first("name")}}</p>
    			  @enderror
                </div>
                <div class="form-group col-6">
                  <b><label for="usr">Duration (in minutes)* :</label></b>
                  <input type="number" class="form-control" name="duration" value="{{old('duration', ($exam->duration ? $exam->duration : '' ))}}" required>
                  @error("duration")
    				<p style="color:red">{{$errors->first("duration")}}</p>
    			  @enderror
                </div>
                <div class="form-group col-6">
                  <b><label for="usr">Pass Mark* :</label></b>
                  <input type="number" class="form-control" name="pass_mark" value="{{old('pass_mark', ($exam->pass_mark ? $exam->pass_mark : '' ))}}" required>
                  @error("pass_mark")
    				<p style="color:red">{{$errors->first("pass_mark")}}</p>
    			  @enderror
                </div>
                <div class="form-group col-6">
                    <b><label for="exampleFormControlSelect1" class="" style="">Status* :</label></b>
                    <select class="form-control" id="exampleFormControlSelect1" name="status" required>
                        <option value="">Select status</option>
                        <option value="1" {{ old('status',$exam->status)== '1' ? 'selected' : '' }} >Publish</option>
                        <option value="0" {{ old('status',$exam->status)== '0' ? 'selected' : '' }} >Archive</option>
                    </select>
                    @error("status")
    				    <p style="color:red">{{$errors->first("status")}}</p>
    			    @enderror
                </div>
            </div>
        
            
            <hr style="border-width: 6px;">
        
            <h3 class="font-size-lg text-dark font-weight-bold">Questions</h3>
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-success btn-icon float-right" id="add-question-fields"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            @if($exam->id != null)
                <?php $i = 0; ?>
            	@foreach($exam->examQuestions as $question)
                    <?php $i = $loop->iteration; ?>
                	@if(!$loop->first)
                	 <hr style="border-width: 2px;" class="question-form-{{$i}}">
                	@endif
                <div class="row question-form-{{$i}}">
                    <div class="col-12">
                        <button type="button" class="btn btn-danger btn-icon float-right" onclick="removeQuestionForm({{$i}})"><i class="fa fa-times"></i></button>
                    </div>
        		    <input type="hidden" name="question_id[]" value="{{ $question->id }}" >
                    
                    <div class="col-8 form-group">
                        <b><label>({{$i}}) Question :</label></b>
                        <textarea class="form-control" rows="2" name="question[]" required>{{ old('question[]', $question->question) }}</textarea>
                        @if($errors->has('question'))
                          <div class="fv-plugins-message-container">
                             <div  class="fv-help-block">{{ $errors->first('question') }}</div>
                          </div>
                        @endif
                    </div>
                    <div class="form-group col-4">
                        <b><label class="" style="">Correct Choice* :</label></b>
                        <select class="form-control" name="correct_choice[]" required>
                            <option value="">Select Correct Choice</option>
                            <option value="a" {{ old('correct_choice[]',$question->correct_choice)== 'a' ? 'selected' : '' }} >a</option>
                            <option value="b" {{ old('correct_choice[]',$question->correct_choice)== 'b' ? 'selected' : '' }} >b</option>
                            <option value="c" {{ old('correct_choice[]',$question->correct_choice)== 'c' ? 'selected' : '' }} >c</option>
                            <option value="d" {{ old('correct_choice[]',$question->correct_choice)== 'd' ? 'selected' : '' }} >d</option>
                        </select>
                        @error("correct_choice")
                            <p style="color:red">{{$errors->first("correct_choice")}}</p>
                        @enderror
                    </div>
                    <div class="col-3 form-group">
                        <b><label>Choice (a) :</label></b>
                        <input type="text" class="form-control" name="choice_a[]" value="{{ old('choice_a[]', $question->choice_a) }}" placeholder="" required>
                        @if($errors->has('choice_a'))
                          <div class="fv-plugins-message-container">
                             <div  class="fv-help-block">{{ $errors->first('choice_a') }}</div>
                          </div>
                        @endif
                    </div>
                    <div class="col-3 form-group">
                        <b><label>Choice (b) :</label></b>
                        <input type="text" class="form-control" name="choice_b[]" value="{{ old('choice_b[]', $question->choice_b) }}" placeholder="" required>
                        @if($errors->has('choice_b'))
                          <div class="fv-plugins-message-container">
                             <div  class="fv-help-block">{{ $errors->first('choice_b') }}</div>
                          </div>
                        @endif
                    </div>
                    <div class="col-3 form-group">
                        <b><label>Choice (c) :</label></b>
                        <input type="text" class="form-control" name="choice_c[]" value="{{ old('choice_c[]', $question->choice_c) }}" placeholder="" required>
                        @if($errors->has('choice_c'))
                          <div class="fv-plugins-message-container">
                             <div  class="fv-help-block">{{ $errors->first('choice_c') }}</div>
                          </div>
                        @endif
                    </div>
                    <div class="col-3 form-group">
                        <b><label>Choice (d) :</label></b>
                        <input type="text" class="form-control" name="choice_d[]" value="{{ old('choice_d[]', $question->choice_d) }}" placeholder="" required>
                        @if($errors->has('choice_d'))
                          <div class="fv-plugins-message-container">
                             <div  class="fv-help-block">{{ $errors->first('choice_d') }}</div>
                          </div>
                        @endif
                    </div>
                </div>
            	@endforeach
                <input type="hidden" id="iteration" name="iteration" value="{{$i}}">
            @else
                <div class="row">
                    <div class="col-8 form-group">
                        <b><label>(1) Question :</label></b>
                        <textarea class="form-control" rows="2" name="question[]" required>{{ old('question[]') }}</textarea>
                    </div>
                    <div class="col-4 form-group">
                        <b><label>Correct Choice :</label></b>
                        <select class="form-control" name="correct_choice[]" required>
                            <option value="">Select Correct Choice</option>
                            <option value="a" {{ old('correct_choice[]')== 'a' ? 'selected' : '' }} >a</option>
                            <option value="b" {{ old('correct_choice[]')== 'b' ? 'selected' : '' }} >b</option>
                            <option value="c" {{ old('correct_choice[]')== 'c' ? 'selected' : '' }} >c</option>
                            <option value="d" {{ old('correct_choice[]')== 'd' ? 'selected' : '' }} >d</option>
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <b><label>Choice (a) :</label></b>
                        <input type="text" class="form-control" name="choice_a[]" value="{{ old('choice_a[]') }}" placeholder="" required>
                    </div>
                    <div class="col-3 form-group">
                        <b><label>Choice (b) :</label></b>
                        <input type="text" class="form-control" name="choice_b[]" value="{{ old('choice_b[]') }}" placeholder="" required>
                    </div>
                    <div class="col-3 form-group">
                        <b><label>Choice (c) :</label></b>
                        <input type="text" class="form-control" name="choice_c[]" value="{{ old('choice_c[]') }}" placeholder="" required>
                    </div>
                    <div class="col-3 form-group">
                        <b><label>Choice (d) :</label></b>
                        <input type="text" class="form-control" name="choice_d[]" value="{{ old('choice_d[]') }}" placeholder="" required>
                    </div>
                </div>
                <input type="hidden" id="iteration" name="iteration" value="1">
            @endif
            <div class="new-question-fields">
                        
            </div>
                
        </div>
        
        <div class="card-footer">
            <div class="row">
                <div class="form-group col-6">
                  <button type="submit" class="btn btn-success mr-3">Save</button>
                  <a class="btn btn-secondary ml-3" href="{{ route('teacher.exam.index') }}">Cancel</a>
                </div>
            </div>
        </div>
        </form>
        
        
    </div>
    <!-- /.container-fluid -->
@endsection

@push('style')
<link href="{{ asset('css/image-uploader.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('script') 
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="{{ asset('js/image-upload.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
           $('.ckeditor').ckeditor();
        });
        
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>
    
    
    <script>
        
        var i = $('#iteration').val();
        
        $('#add-question-fields').click(function() {
            i++;
            $(".new-question-fields").append(`<hr style="border-width: 2px;" class="question-form-`+i+`">
                    <div class="row question-form-`+i+`">
                        <div class="col-12">
                            <button type="button" class="btn btn-danger btn-icon float-right" onclick="removeQuestionForm(`+i+`)"><i class="fa fa-times"></i></button>
                        </div>
                        <input type="hidden" name="question_id[]" >
                        <div class="col-8 form-group">
                            <b><label>(`+i+`) Question :</label></b>
                            <textarea class="form-control" rows="2" name="question[]" required>{{ old('question[]') }}</textarea>
                        </div>
                        <div class="col-4 form-group">
                            <b><label>Correct Choice :</label></b>
                            <select class="form-control" name="correct_choice[]" required>
                                <option value="">Select Correct Choice</option>
                                <option value="a" {{ old('correct_choice[]')== 'a' ? 'selected' : '' }} >a</option>
                                <option value="b" {{ old('correct_choice[]')== 'b' ? 'selected' : '' }} >b</option>
                                <option value="c" {{ old('correct_choice[]')== 'c' ? 'selected' : '' }} >c</option>
                                <option value="d" {{ old('correct_choice[]')== 'd' ? 'selected' : '' }} >d</option>
                            </select>
                        </div>
                        <div class="col-3 form-group">
                            <b><label>Choice (a) :</label></b>
                            <input type="text" class="form-control" name="choice_a[]" value="{{ old('choice_a[]') }}" placeholder="" required>
                        </div>
                        <div class="col-3 form-group">
                            <b><label>Choice (b) :</label></b>
                            <input type="text" class="form-control" name="choice_b[]" value="{{ old('choice_b[]') }}" placeholder="" required>
                        </div>
                        <div class="col-3 form-group">
                            <b><label>Choice (c) :</label></b>
                            <input type="text" class="form-control" name="choice_c[]" value="{{ old('choice_c[]') }}" placeholder="" required>
                        </div>
                        <div class="col-3 form-group">
                            <b><label>Choice (d) :</label></b>
                            <input type="text" class="form-control" name="choice_d[]" value="{{ old('choice_d[]') }}" placeholder="" required>
                        </div>
                    </div>`);
        });
        
        function removeQuestionForm(i) {
            $(".question-form-"+i).remove();
        }
    </script>
    
@endpush