@extends("teacher.layouts.app")
@section('title', 'Exam')
@section("content")

    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if(session()->has('success message'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('success message') }}
            </div>
        @elseif(session()->has('failed message'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('failed message') }}
            </div>
        @endif
        <div class="row">
            <!-- Page Heading -->
            <div class="col-6">
            <h1 class="h3 mb-2 text-gray-800">Exam</h1>
            </div>
            <div class="col-6 text-right">
            <a href="{{route('teacher.exam.create')}}" class="btn btn-primary" ><i class="fa fa-plus"></i> Add</a>
            </div>
        </div>
        <!--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.-->
        <!--    For more information about DataTables, please visit the <a target="_blank"-->
        <!--        href="https://datatables.net">official DataTables documentation</a>.</p>-->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!--<div class="card-header py-3">-->
            <!--    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>-->
            <!--</div>-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SI No.</th>
                                <th>Name</th>
                                <th>Duration (in minutes)</th>
                                <th>Pass Mark</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exams as $val)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->duration}}</td>
                            <td>{{$val->pass_mark}}</td>
                            <td>
                                @if($val->status != '1')
                                    <span class="text-danger">Archived</span>
                                @else
                                    <span class="text-success">Published</span>
                                @endif 
                            </td>
                            <td>
                                {{-- <a href="#" class="" title="View" onclick="viewFunction({{$val->id}})"><i class="fa fa-eye"></i></a> &nbsp; --}}
                                <a href="{{ route('teacher.exam.edit', $val->id) }}" class="" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;
                                <a href="#" class="exam-delete" title="Delete" data-toggle="modal" data-target="#deleteModal" data-href="{{ route('teacher.exam.destroy', $val->id) }}"><i class="fa fa-trash"></i></a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection

   @push('modal')      

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete this data?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Delete</a>
                    
                    <form id="delete-form" action="" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                                    
                </div>
            </div>
        </div>
    </div>

  <div class="modal fade" id="viewModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">View Exam</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="">
                <table class="table table-borderless">
                    <tr>
                        <th>Name </th><th>:</th><td id="name_view"></td>
                    </tr>
                </table>
               
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
  @endpush

  @push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <!--<script src="{{ asset('js/jquery.toast.min.js')}}" type="text/javascript"></script>-->
    <!--<script src="{{ asset('js/toastr.js')}}" type="text/javascript"></script>-->
    <script type="text/javascript">
        
    setTimeout(function() {
    $('.alert-success').fadeOut();
    }, 5000)
    
    setTimeout(function() {
    $('.alert-danger').fadeOut();
    }, 5000)
    
    function makeTitle(slug) {
    var words = slug.split('-');

    for (var i = 0; i < words.length; i++) {
        var word = words[i];
    words[i] = word.charAt(0).toUpperCase() + word.slice(1);
    }

    return words.join(' ');
    }

    $('.exam-delete').click(function() {
        var data_href=$(this).data('href');
        $('#delete-form').attr('action',data_href);
    });
    </script>
  @endpush